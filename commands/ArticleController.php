<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\modules\article\models\Article;
use \app\commands\db\Query;

class ArticleController extends Controller
{
    /**
     * 修补地区数据
     */
    /*
    public function actionRepair()
    {
        $query = new Query();
        $records = $query->from('article');

        foreach($records->each(1000) as $row) {
            $pos = strrpos($row['title'],'_');
            $t = trim(substr($row['title'], 0,$pos));
            $datas = [
                'title' => $t
            ];
            $a = Article::findOne($row['id']);
            $a->title = $t;
            $a->save();
            print $a->title;
            print "\n";
        }
        
    }*/

    /*
    public function actionRepair1()
    {
        $query = new Query();
        $records = $query->from('article');

        foreach($records->each(1000) as $row) {
            $t = trim(mb_substr($row['cover'], 0,2));
            if ( $t == '/u') {
                $a = Article::findOne($row['id']);
                $cover = 'http://love.heima.com'.$row['cover'];
                $a->cover = $cover;
                $a->save();
            }

        }
        
    }*/
}
