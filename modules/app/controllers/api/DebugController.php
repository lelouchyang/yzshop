<?php
namespace app\modules\app\controllers\api;

use Yii;
use \app\modules\api\controllers\ApiController;
use \app\modules\app\models\AppDebug;

/**
 * @name App相关控制器
 */
class DebugController extends ApiController
{

    /**
     * @name 设备debug记录
     */
    public function actionIndex()
    {
        $Debug = new AppDebug();
        $Debug->setAttributes($this->params, false);
        $Debug->insert();
        $this->datas['debug_id'] = $Debug->id;
        $this->datas['debug_url'] = '';
    }

    /**
     * @name 测试API
     */
    public function actionTest()
    {
        $str = <<<HTML
<p>　</p><p>&nbsp; &nbsp; &nbsp; &nbsp; 3月5日，第11届“日中韩腹腔镜胃癌联席会议”(以下简称“联席会议”)在上海举行，来自中、日、韩三国的顶级腹腔镜胃癌专家均悉数到场，代表着当今世界腹腔镜胃癌手术领域的最高水平。受中华医学会外科分会腹腔镜与内镜外科学组组长、上海交通大学医学院附属瑞金医院副院长郑民华教授的邀请，我院胃外科郑朝辉、李平副教授赴沪参会并作主旨演讲。与会期间，郑教授和李教授分别作了关于《An
jejunum-later-cut Overlap for esophagojejunostomy in totally laparoscopic total
gastrectomy for gastric cancer》和《Is all advanced gastric cancer suitable for
laparoscopy-assisted gastrectomy with extended lymphadenectomy? A case-control
study using a propensity score
method》的全英文学术演讲。两位教授通过我院胃外科高清的手术视频，毫无保留地向国际同行分享了我院胃外科创新的全腹腔镜下消化道重建方式;并根据详实的临床数据，客观地探讨了腹腔镜胃癌根治术的手术适应症，再次展示我院胃外科在该领域的国际一流水平，受到与会专家们的高度认可。</p><p>　　据悉，“联席会议”每年一届，并由日、中、韩三国轮转主办，组委会仅邀请参会各国腹腔镜胃癌外科领域公认的一流专家参加。其中，部分参会专家是目前国际胃癌治疗指南的制定者和执笔人。一年一度的“联席会议”代表着当今世界腹腔镜胃癌外科界的最高学术舞台。我院胃外科已连续4年受邀在“联席会议”上作主旨发言，进一步确立了胃外科在腹腔镜胃癌外科领域的国际领先地位。</p><p>　　</p><img height="265" alt="" src="/upload/editor/20160318/20160318092013.jpg" width="420" border="0" vspace="0" title="" style="width: 420px; height: 265px;"/></p><p>　　与会专家全家福</p><p>　　</p><img height="265" alt="" src="/upload/editor/20160318/20160318092014.jpg" width="420" border="0" vspace="0" title="" style="width: 420px; height: 265px;"/></p><p>　　黄昌明教授与日韩专家共同主持会议</p><p>　　</p><img height="209" alt="" src="/upload/editor/20160318/20160318092015.jpg" width="420" border="0" vspace="0" title="" style="width: 420px; height: 209px;"/></p><p>　　郑朝辉副教授作大会发言</p><p>　　</p><img height="265" alt="" src="/upload/editor/20160318/20160318092016.jpg" width="420" border="0" vspace="0" title="" style="width: 420px; height: 265px;"/></p><p>　　李平副教授作大会发言</p>
HTML;

        $this->datas['content'] = $str;
    }


}
