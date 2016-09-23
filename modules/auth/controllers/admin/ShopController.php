<?php
namespace app\modules\auth\controllers\admin;

use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\AdminController;
use \app\modules\yz\models\YzHospital;


/**
 * @name 商户管理移动端控制器
 */
class ShopController extends AdminController 
{

    public $layout = '@app/modules/admin/views/layouts/m';



    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @name 商户注册
     */
    public function actionRegister()
    {
        // 获取医院ID
        $hos_id = $this->request->get('hos_id');

        /*
        $hospitals = YzHospital::find()
                            ->where(['valid'=>1])
                            ->andWhere(['<>', 'province', ''])
                            ->andWhere(['<>', 'city', ''])
                            ->all();

        $provinces = [];
        foreach( $hospitals as $hos ) {
            $provinces[] = $hos->province;
        }

        dump(array_$provinces);
        die;
         */

        /*
        $province = DB::table('hospital')->select('province')->distinct()->where('province','>',0)->where('valid',1)->get();
        $city = DB::table('hospital')->select('city','province')->distinct()->where('city','>',0)->where('valid',1)->get();
        $hospital_id=$this->hospital_id=$request->get('hospital_id','');//医院id
       
        if($this->hospital_id=='' || $this->hospital_id==0 || !is_numeric($this->hospital_id) ){
            $hospital=DB::table('hospital')->where('valid',1)->get();
        */


        return $this->render('register', ['hospitals' => []]);
    }

    



}

