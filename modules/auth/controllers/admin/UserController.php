<?php
namespace app\modules\auth\controllers\admin;

use Yii;
use \app\mysite\helpers\Url;
use \app\mysite\web\AdminController;
use \app\mysite\models\AuthUser;
use \app\mysite\models\AuthRole;
use \app\modules\comment\models\Comment;
use \app\modules\score\models\Score;
use \app\modules\order\models\OrderInfo;
use \app\modules\order\models\OrderDetail;
use \app\modules\shop\models\Shop;
use \app\modules\shop\models\ShopGoods as Goods;
use \app\modules\shop\models\ShopGoodsCategory as GoodsCate;

/**
 * @name 账号管理控制器
 */
class UserController extends AdminController 
{
    /**
     * @name 账号管理
     * @menu true
     */
    public function actionIndex()
    {
        $datas = AuthUser::find()
                        ->where(['is_staff'=>1])
                        ->andWhere(['status' => 1])
                        ->orderby('id asc')
                        ->pagination();

        return $this->render('index', $datas);
    }

    /**
     * @name 商户账号管理
     * @menu true
     */
    public function actionShop()
    {
        $mobile = $this->request->get('mobile');

        $query = AuthUser::find()
                        ->where(['status' => 1])
                        ->andWhere(['is_shop_user' => 1])
                        ->orderBy('id desc');

        if ( $mobile ) {
            $query->andWhere(['like','mobile' ,$mobile]);
        } else {
            $_GET['mobile'] = '';
        }

        $totalAmount = $query->count();

        $datas = $query->pagination();
        $datas['totalAmount'] = $totalAmount;
        $datas['get'] = $this->request->get();

        $this->view->title = "商户账户管理";
        return $this->render('shop', $datas);
    }

    /**
     * @name 添加/编辑账号
     */
    public function actionEdit()
    {
        $action = $this->request->get('action');
        if ( !in_array($action, ['add','update']) ) {
            http404();
        }
        return $this->$action();
    }

    /**
     * 添加账号
     */
    protected function add()
    {
        if ( $this->Request->isPost ) {

            $post = $this->request->post();

            $user = new AuthUser();
            $user->setAttributes($post, false);
            $user->password = \app\mysite\Auth::hash($post['password']);

            if (empty($post['is_staff'])) {
                $post['is_staff'] = 0;
            }
            if (empty($post['is_super'])) {
                $post['is_super'] = 0;
            }

            $user->save();

            $this->redirect(Url::toRoute('/auth/admin/user'));

        }
        $user = new AuthUser();
        $user->loadDefaultValues();
        $this->view->title = "添加客户信息";
        return $this->render('edit', ['user'=>$user]);
    }

    /**
     * 编辑账号
     */
    protected function update()
    {
        if ( $this->request->isPost ) {


            $post = $this->request->post();
            $user = AuthUser::findOne($post['id']);
            if ( !isset($post['password']) ) {
                unset($post['password']);
            } else {
                $post['password'] = \app\mysite\Auth::hash($post['password']);
            }

            if (empty($post['is_staff'])) {
                $post['is_staff'] = 0;
            }
            if (empty($post['is_super'])) {
                $post['is_super'] = 0;
            }

            $uploader = \app\mysite\web\Upload::process('avatar', 'avatar');

            if ( $uploader ) {
                $post['avatar'] = $uploader->shortNewFile;
            }

            $user->setAttributes($post, false);
            $user->save();
            $this->redirect(Url::to('/auth/admin/user.html'));
        }
        $id = $this->request->get('id');

        $user = AuthUser::findOne($id);

        $this->view->title = "修改客户信息";
        return $this->render('edit', [
            'user' => $user
        ]);
    }

    /**
     * @name 编辑账号权限组
     */
    public function actionEditRole()
    {
        if ( $this->request->isPost ) {
            $user_id = $this->request->post('user_id');
            $role_ids = $this->request->post('role_id', []);

            $db = Yii::$app->db;
            $db->createCommand()->delete('auth_role_user', [
                'user_id' => $user_id
            ])->execute();

            $datas = [];
            foreach( $role_ids as $role_id ) {
                $datas[] = [ $role_id, $user_id ];
            }
            $db->createCommand()->batchInsert('auth_role_user', ['role_id', 'user_id'],$datas)->execute();

            return $this->json([
                'datas'  => null,
                'msg'    => 'ok',
                'status' => 1
            ]);
        }
        $id = $this->request->get('id');
        $user  = AuthUser::findOne($id);
        $roles = AuthRole::find()
                        ->where(['status'=>1])
                        ->all();

        $has_roles = $user->getRoles();

        return $this->renderPartial('editRole',[ 
            'user'      => $user,
            'roles'     => $roles,
            'has_roles' => $has_roles
        ]);
    }

    /**
     * @name 物理清除商户所有相关信息
     */
    public function actionClearShopUser()
    {
        $userId = $this->request->get('id');
        if ( !$userId ) {
            return "用户ID不存在";
        }

        $User = AuthUser::find()
            ->where(['status'=>1])
            ->where(['id'=>$userId])
            ->andWhere(['is_shop_user'=>1])
            ->one();

        if ( !$User )
        {
            return "用户不存在!";
        }

        $Shop = $User->shop;

        # 清除评论
        Comment::deleteAll(['own_user_id' => $userId]);
        # 清除评分
        Score::deleteAll(['user_id' => $userId]);
        # 清除订单
        OrderInfo::deleteAll(['own_user_id' => $userId]);
        # 清除分类
        GoodsCate::deleteAll(['user_id'=>$userId]);
        # 清除商品
        Goods::deleteAll(['user_id'=>$userId]);
        #清除医院关系
        $sql = <<<SQL
DELETE FROM `shop_hospital` WHERE `shop_id`=:shop_id
SQL;
        Query($sql)->bindValue(':shop_id', (int)$Shop->id)->execute();
        #清除标签关系
        $sql = <<<SQL
DELETE FROM `shop_tag_rel` WHERE shop_id=:shop_id
SQL;
        Query($sql)->bindValue(':shop_id', (int)$Shop->id)->execute();
        # 清除商铺数据
        if ( $Shop ) {
            $Shop->delete();
        }
        # 清除用户数据
        $User->delete();

        return $this->json([
            'datas'  => null,
            'msg'    => 'ok',
            'status' => 1
        ]);
    }

    

}

