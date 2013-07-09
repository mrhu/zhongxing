<?php

class AccountController extends SBaseController
{
    public $layout = "/layouts/account";
    //init
    public function init()
    {
        //init css and javascript
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile(Yii::app()->baseUrl . '/js/base.js');
        $cs->registerScriptFile(Yii::app()->baseUrl . '/js/validate_tab.js');
        $cs->registerScriptFile(Yii::app()->baseUrl .
            '/js/My97DatePicker/WdatePicker.js');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/user.css');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/user_new.css');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/index.css');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/main_user.css');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/user.css');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/css.css');
        //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/validate/user.css');
    }
    //账户详情
    public function actionIndex()
    {
        $this->render('index');
    }
    /**
     * info = array('webname'=>,)
     * 
     */
    public function actionBank()
    {
        $webname = System::model()->find('nid=:nid', array(':nid' => 'con_webname'))->
            value;
        $bank = AccountBank::model()->find('user_id=:user_id', array(':user_id' => Yii::
                app()->user->id));
        if ($webname == null)
            $webname = '网站名称未设置';
        if (isset($_POST['bank'])) {
            if ($bank == null) {
                $bank = new AccountBank;
                $array = array(
                    'user_id' => Yii::app()->user->id,
                    'addtime' => time(),
                    'addip' => Yii::app()->request->getUserHostAddress(),
                    );
                $bank->attributes = array_merge($array, $_POST['bank']);
                if (!$bank->save())
                    throw new CException('Save to bank table error');
                $this->layout = "//layouts/main";
                $this->render('//site/msg', array(
                    'msg' => '添加成功',
                    'msg_url' => Yii::app()->request->urlReferrer,
                    'msg_content' => '点击返回'));
            } else {
                $bank->attributes = $_POST['bank'];
                if (!$bank->update())
                    throw new CException('update to bank error');
                $this->layout = "//layouts/main";
                $this->render('//site/msg', array(
                    'msg' => '更新成功',
                    'msg_url' => Yii::app()->request->urlReferrer,
                    'msg_content' => '点击返回'));
            }
        } else {
            $bank_status = ($bank == null) ? 0 : 1;
            //$bank = Linkage::model()->findByPk($bank)
            if ($bank_status == 1)
                $bankname = Linkage::model()->findByPk($bank->bank)->value;
            else
                $bankname = null;
            $user = User::model()->findByPk(Yii::app()->user->id);
            $this->render('bank', array(
                'webname' => $webname,
                'bankname' => $bankname,
                'bank' => $bank,
                'bank_status' => $bank_status,
                'user' => $user));
        }

    }
    public function actionRecharge()
    {
        $this->render('recharge');
    }
    public function actionRechargeLog()
    {
        $this->render('rechargelog');
    }
    public function actionCash()
    {
        $this->render('cash');
    }
    public function actionCashLog()
    {
        $this->render('cashlog');
    }
    public function actionLog()
    {
        $this->render('log');
    }
    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
    // return the filter configuration for this controller, e.g.:
    return array(
    'inlineFilterName',
    array(
    'class'=>'path.to.FilterClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }

    public function actions()
    {
    // return external action classes, e.g.:
    return array(
    'action1'=>'path.to.ActionClass',
    'action2'=>array(
    'class'=>'path.to.AnotherActionClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }
    */
}