<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\models\SysParams;

/**
 * @name 配置管理
 * @panel 10
 */
class ParamController extends AdminController
{

    /**
     * @name 查看整站配置
     */
    public function actionSystem()
    {
        $datas = [
            'params' => Yii::$app->params
        ]; 
        $this->view->title = "查看整站配置";
        return $this->render('system', $datas);
    }


    /**
     * @name 系统配置管理
     * @menu true
     */
    public function actionIndex()
    {
        $params = SysParams::find()->orderBy(['created'=>SORT_ASC])->all();

        $datas = [
            'params' => $params
        ];

        $this->view->title = "系统配置管理";
        return $this->render('index', $datas);
    }

    /**
     * @name 添加/修改配置
     */
    public function actionEdit()
    {
        $actions = ['add', 'update'];
        $action = $this->request->get('action', 'add');
        if ( !in_array($action, $actions) ) {
            http404();
        }

        return $this->$action();
    
    }

    /**
     * 添加
     */
    public function add()
    {
        if ( $this->request->isPost ) {

            $name = $this->request->post('name');
            $type = $this->request->post('type');

            if ( $type == 'string') {
                $value = $this->request->post('value', '');
            } else if ( $type == 'array' ) {
                $values = $this->request->post('array_value', []);
                $value = \yii\helpers\Json::encode($values);
            } else if ( $type ==  "dictory" ) {
                $keys = $this->request->post('dict_key', []);
                $values = $this->request->post('dict_value', []);
                foreach( $keys as $k=>$v ) {
                    if ( $v == '' ) {
                        unset($values[$k]);
                        unset($keys[$k]);
                    }
                }
                $value = \yii\helpers\Json::encode(array_combine($keys, $values));
            }
            $des = $this->request->post('des');
            $params = new SysParams();
            $params->name = $name;
            $params->value = $value;
            $params->type = $type;
            $params->des = $des;
            $params->save();

            return $this->json([
                'data' => $params->toArray(),
                'msg' => '添加成功',
                'status' => '0',
            ]);
        }

        $param = new SysParams();
        $param = $param->loadDefaultValues();
        return $this->renderPartial('edit', ['param'=>$param]);
    }

    /**
     * 更新
     */
    public function update()
    {
        if ( $this->request->isPost ) 
        {
            $id   = $this->request->post('id');
            $name = $this->request->post('name');
            $type = $this->request->post('type');

            if ( $type == 'string') {
                $value = $this->request->post('value', '');
            } else if ( $type == 'array' ) {
                $values = $this->request->post('array_value', []);
                $value = \yii\helpers\Json::encode($values);
            } else if ( $type ==  "dictory" ) {
                $keys = $this->request->post('dict_key', []);
                $values = $this->request->post('dict_value', []);
                foreach( $keys as $k=>$v ) {
                    if ( $v == '' ) {
                        unset($values[$k]);
                        unset($keys[$k]);
                    }
                }
                $value = \yii\helpers\Json::encode(array_combine($keys, $values));
            }
            $des = $this->request->post('des');
            $params = SysParams::findOne($id);
            $params->name = $name;
            $params->value = $value;
            $params->type = $type;
            $params->des = $des;
            $params->save();

            return $this->json([
                'msg' => '修改成功',
                'status' => '1',
            ]);
        }
        $id = $this->request->get('id');
        $param = SysParams::findOne($id);
        $datas = [
            'param' => $param
        ];
        return $this->renderPartial('edit', $datas);
    }

    /**
     * @name 删除配置
     */
    public function actionDelete()
    {
        $id = $this->request->get('id');
        $param = SysParams::findOne($id);
        $param->delete();
        return $this->json([
            'msg'    => '删除成功',
            'status' => '1',
        ]);
    }

}

