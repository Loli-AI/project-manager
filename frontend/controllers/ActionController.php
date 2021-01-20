<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Lists;
use frontend\models\Cards;
use common\models\User;
use frontend\models\Comments;
use frontend\models\Projects;
use yii\web\Response;
use yii\helpers\Json;

/**
 * Site controller
 */
class ActionController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add-list', 'add-comment', 'add-card', 'get-lists', 'get-cards', 'get-card-data', 'get-comment', 'edit-card', 'delete-list', 'delete-card', 'move-card', 'edit-card-title', 'edit-list-title', 'get-projects'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add-list', 'add-comment', 'add-card', 'get-lists', 'get-cards', 'get-card-data', 'get-comment', 'edit-card', 'delete-list', 'delete-card', 'move-card', 'edit-card-title', 'edit-list-title', 'get-projects', 'upload-image'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-list' => ['post'],
                    'add-comment' => ['post'],
                    'add-card' => ['post'],
                    'get-lists' => ['post'],
                    'get-cards' => ['post'],
                    'get-card-data' => ['post'],
                    'get-comment' => ['post'],
                    'edit-card' => ['post'],
                    'delete-list' => ['post'],
                    'delete-card' => ['post'],
                    'move-card' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionGetComment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $comment = Comments::find()->where(["id" => $req->post("id")])->one();
            $user = User::find()->where(['id' => $comment["id_user"]])->one();

            $comment_data = array(
                    "id" => $comment["id"],
                    "message" => $comment["message"],
                    "user" => $user['username'],
                    "date" => $comment["date"],
                );


            return [
                'response' => array('comment_data' => $comment_data),
            ];
        }
        $this->redirect('/site/error');
    }

    public function actionEditCardDescription()
    {
        $req = Yii::$app->request;
        
        if ($req->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $card = Cards::find()->where(["id" => $req->post("id")])->one();
            $card->description = $req->post("data");
            $card->save();

            $updated_card = Cards::find()->where(["id" => $req->post("id")])->one();
            $datas = [
                'id' => $req->post("id"),
                'title' => $updated_card['title'],
                'description' => $updated_card['description'],
                'id_comment' => $updated_card['id_comment'],
                'date' => $updated_card['date'],
            ];

            return [
                'response' => $datas
            ];
        }

        $this->redirect('/site/error');
    }

    public function actionGetCardData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $card = Cards::find()->where(["id" => $req->post("id")])->one();
            $cardData = [];
            
            $datas = array(
                "id" => $card["id"],
                "title" => $card["title"],
                "description" => $card["description"],
                "id_comment" => $card["id_comment"],
                "date" => $card["date"],
            );
            array_push($cardData, $datas);

            return [
                'response' => array('cardData' => $cardData, ),
            ];
        }
        $this->redirect('/site/error');
    }

    public function actionGetCards()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $cards = Cards::find()->where(["id" => $req->post("id")])->one();
            $allCard = [];

            $datas = array(
                "id" => $cards["id"],
                "title" => $cards["title"],
                "date" => $cards["date"],
            );
            array_push($allCard, $datas);

            return [
                'response' => array('allCard' => $allCard, ),
            ];
        }
        $this->redirect('/site/error');
    }

    public function actionAddCard()
    {
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $id = $req->post("card_id");
            $cards = new Cards;
            $cards->title = $req->post("title");
            $cards->description = $req->post("description");
            $cards->id_comment = "";
            $cards->id_user = Yii::$app->user->identity->id;
            $cards->save();

            $card = Cards::find()->orderBy(["id" => SORT_DESC])->one();
            $list = Lists::find()->where(['id' => $id])->one();
            $list->id_card .= "{$card['id']}|";
            $list->save();
            return $req->post("title");
        }
        $this->redirect('/site/error');
    }

    public function actionMoveCard()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $list = Lists::find()->where(["id" => $req->post("idList")])->one();
            $lastList = Lists::find()->where(["id" => $req->post("idLastList")])->one();
            $new_card_id = "";
            $id_cards = explode("|", $list->id_card);
            $id_cards_last_list = explode("|", $lastList->id_card);

            if (array_search($req->post("idCard"), $id_cards) === false) {
                $list->id_card = $list->id_card . $req->post("idCard") . '|';
                $list->save();

                unset($id_cards_last_list[array_search($req->post("idCard"), $id_cards_last_list)]);
                array_pop($id_cards_last_list);

                foreach ($id_cards_last_list as $key => $value) {
                    $new_card_id .= $value . "|";
                }
                
                $lastList->id_card = $new_card_id;
                $lastList->save();
            } else {
                unset($id_cards_last_list[array_search($req->post("idCard"), $id_cards_last_list)]);
                array_pop($id_cards_last_list);

                if (count($id_cards_last_list) < 1) {
                    $lastList->id_card = $req->post("idCard") . "|";
                } else {
                    foreach ($id_cards_last_list as $key => $value) {
                        $new_card_id .= $value . "|";
                    }
                    $lastList->id_card = $new_card_id . $req->post("idCard") . "|";
                }
                
                $lastList->save();
            }
            return false;
        }
        $this->redirect('/site/error');
    }

    public function actionDeleteCard()
    {
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $new_card_id = "";
            $ids = explode("|", $req->post("id"));
            $card = Cards::find()->where(['id' => $ids[0]])->one();
            $list = Lists::find()->where(["id" => $ids[1]])->one();

            $id_card = explode("|", $list->id_card);

            unset($id_card[array_search($ids[0], $id_card)]);
            array_pop($id_card);

            foreach ($id_card as $key => $value) {
                $new_card_id .= $value . "|";
            }

            $list->id_card = $new_card_id;
            $list->save();

            Cards::find()->where(['id'=>$ids[0]])->one()->delete();
            
            return $card["title"];
        }
        $this->redirect('/site/error');
    }

    public function actionDeleteList()
    {
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $new_list_id = "";
            $id = $req->post("id");
            $list = Lists::find()->where(['id' => $id])->one();
            Lists::find()->where(['id'=>$id])->one()->delete();

            $project = Projects::find()->where(['name' => Yii::$app->session->get('project')])->one();
            
            $id_list = explode("|", $project->id_list);
            unset($id_list[array_search($id, $id_list)]);
            array_pop($id_list);

            foreach ($id_list as $value) {
                $new_list_id .= $value . "|";
            }

            $project->id_list = $new_list_id;
            $project->save();

            return $list['title'];
        }
        $this->redirect('/site/error');
    }

    public function actionAddList()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($req->isAjax) {
            $res = ['data' => $req->post()];
            $newList = new Lists();
            $newList->title = $res["data"]["title"];
            $newList->id_user = Yii::$app->user->identity->id;
            $newList->save();
            
            $project = Projects::find()->where(['name' => Yii::$app->session->get('project')])->one();
            $list = Lists::find()->orderBy(['id' => SORT_DESC])->one();

            $project->id_list .= $list->id . "|";
            $project->save();
            
            return $res["data"]["title"];
        }
        $this->redirect('/site/error');
    }

    public function actionAddComment()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($req->isAjax) {
            $comment = new Comments();
            $comment->message = $req->post("data");
            $comment->id_user = Yii::$app->user->identity->id;
            $comment->save();

            $new_comment = Comments::find()->orderBy(['id' => SORT_DESC])->one();

            $card = Cards::find()->where(['id' => $req->post('id')])->one();
            $card->id_comment = $card->id_comment . $new_comment->id . "|";
            $card->save();
            return false;
        }
        $this->redirect('/site/error');
    }

    public function actionEditCardTitle()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($req->isAjax) {
            $card = Cards::find()->where(['id' => $req->post("id")])->one();
            $card->title = $req->post("data");
            $card->save();
            return false;
        }
        $this->redirect('/site/error');
    }

    public function actionEditListTitle()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($req->isAjax) {
            $list = Lists::find()->where(['id' => $req->post('id')])->one();
            $old_list = $list->title;
            $list->title = $req->post('data');
            $list->save();

            return [$old_list, $list->title];
        }
        $this->redirect('/site/error');
    }

    public function actionGetProjects()
    {
        $req = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        if ($req->isAjax) {
            $id = Yii::$app->user->identity->id;
            $projects = Projects::find()->where(['is_master' => 1])->all();
            $name = [];
            $relations = [];

            foreach ($projects as $value) {
                $id_user = explode("|", $value->id_user);
                array_pop($id_user);
                if (in_array($id, $id_user)) {
                    array_push($name, $value->name);
                    $relation = explode("|", $value->relation);
                    array_pop($relation);
                    array_push($relations, ...$relation);
                }
            }

            foreach ($relations as $key) {
                $projects = Projects::find()->where(['id' => $key])->one();
                array_push($name, $projects->name);
            }
            return [
                'projects' => $name
            ];

        }
        $this->redirect('/site/error');
    }

    public function actionGetLists()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $id = Yii::$app->user->identity->id;

        if ($req->isAjax) {
            if ($req->post("data") != "") {
                $data = $req->post("data");
            } else {
                $data = Yii::$app->session->get('project');
            }

            $projects = Projects::find()->where(['is_master' => 1])->all();
            $valid = [];

            foreach ($projects as $value) {
                $id_user = explode("|", $value->id_user);
                array_pop($id_user);
                if (in_array($id, $id_user)) {
                    array_push($valid, $value->name);
                    $relation = explode("|", $value->relation);
                    array_pop($relation);
                    foreach ($relation as $value) {
                        $relate = Projects::find()->where(['id' => $value])->one();
                        array_push($valid, $relate->name);
                    }
                }
            }

            if (in_array($data, $valid)) {
                
                $project = Projects::find()->where(['name' => $data])->one();
                $id_list = explode("|", $project->id_list);
                array_pop($id_list);

                $allList = [];

                foreach ($id_list as $value) {
                    $list = Lists::find()->where(["id" => $value])->one();
                    $datas = array(
                        'id' => $list['id'],
                        'title' => $list['title'],
                        'id_card' => $list['id_card'],
                        'id_user' => $list['id_user'],
                        'date' => $list['date'],
                    );
                    array_push($allList, $datas);
                }
            }
            Yii::$app->session->set('project', $data);
            return [
                'response' => array('allList' => $allList),
                'title' => $data
            ];
        }
        $this->redirect('/site/error');
    }

    public function actionUploadImage()
    {
        $req = Yii::$app->request;
        // Yii::$app->response->format = Response::FORMAT_JSON;
        
        if ($req->isAjax) {
            if(empty($_FILES['file'])) {
                exit();
            }

            // $errorImgFile = "./img/img_upload_error.jpg";
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $destinationFilePath = '../web/img-uploads/'.$newfilename;
            $src = "/img-uploads/" . $newfilename;

            if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
                echo "Gagal Memasukkan File";
                return false;
            }
            else{
                echo $src;
                return false;
            }
            

        }
        $this->redirect('/site/error');
    }
}
