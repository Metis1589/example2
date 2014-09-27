<?php
class TodolistController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','complite','restore','admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Todo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Todo']))
		{
			$model->attributes=$_POST['Todo'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Todo']))
		{
			$model->attributes=$_POST['Todo'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));			
	}
        
        /**
	 *
	 * Marks item as usual item without hot label in presentation
	 * @param int $id item's ID
	 */
	public function actionComplite($id)
	{
		$model = $this->loadModel($id);
		$model->is_complted=1;
		$model->save(false,array('is_complted'));
		$this->redirect(Yii::app()->request->urlReferrer);
	}
        
        /**
	 *
	 * Marks item as usual item without hot label in presentation
	 * @param int $id item's ID
	 */
	public function actionRestore($id)
	{
		$model = $this->loadModel($id);
		$model->is_complted=0;
		$model->save(false,array('is_complted'));
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect('/todo/todolist/admin');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Todo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Todo']))
			$model->attributes=$_GET['Todo'];
                        if(isset($_GET['show'])){
                            $model->is_complted = ($_GET['show']=='complited') ? 1 : 0;
                        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Todo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Todo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Todo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='todo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
