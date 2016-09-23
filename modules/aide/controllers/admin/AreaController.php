<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\models\SysArea;

/**
 * @name 行政地区管理
 * @panel 10
 */
class AreaController extends AdminController
{

    /**
     * @name 行政地区列表
     * @menu true
     */
    public function actionIndex()
    {
        $parent_id = $this->request->get('parent_id');

        if ( $parent_id == null ) 
        {
            $areas = SysArea::genTree(null, ['<=', 'level', 2]);
            $this->view->title = "中国行政地区管理";
            return $this->render('index', ['areas'=>$areas]);
        } 
        else
        {
            $areas = SysArea::genTree($parent_id);
            $parentAreas = SysArea::findOne($areas[0]['id'])->getParents(true);
            $titles = ["中国行政地区管理"];
            foreach($parentAreas as $subArea ) 
            {
               $titles[] = $subArea['name']; 
            }
            $this->view->title = implode(' \\ ', $titles);
            return $this->render('index', ['areas'=>$areas]);
        }
    }

    /**
     * @name 生成行政地区Json数据
     */
    public function actionGenJson()
    {
        $datas = SysArea::find()->asArray()->where(['<', 'level', 4])->all();
        $pro_datas  = [];
        $city_datas = [];
        $zone_datas = [];

        foreach($datas as $d) {
            $id = &$d['id'];
            $l =  &$d['level'];
            $p = &$d['parent_id'];
            $n = &$d['name'];
            if ($l == 1) {
                if( !array_key_exists($id, $pro_datas) ) {
                    $pro_datas[$id] = $n;
                    $city_datas[$id] = array();
                }
            } 
            if ($l == 2) {
                $city_datas[$p][$id] = $n;
                $zone_datas[$id] = array();
            }
            if ($l == 3) {
                $zone_datas[$p][$id] = $n;
            }
        
        }

        $filename = implode(DS, [
            realpath('.'), 'assets/datas','sys-areas.js'
        ]);
        $datas = array(
            'pro_datas' => json_encode($pro_datas),
            'city_datas' => json_encode($city_datas),
            'zone_datas' => json_encode($zone_datas),
        );
        $content = $this->renderPartial('area-datas', $datas);
        file_put_contents($filename, $content);
        return "ok";
    }
}

