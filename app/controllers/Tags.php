<?php


class Tags extends Controller
{
    public $tagModel;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->tagModel = $this->model('Tag');
    }

    public function index() {
        $tags = $this->tagModel->getTags();
        $data = array(
            'tags' => $tags
        );
        $this->view('tags/index', $data);
    }

    public function delete($id){
        $tag = $this->tagModel->getTagById($id);
        if($this->tagModel->deleteTag($id)){
            message('post_message', 'Tag Removed');
            redirect('tags');
        } else {
            die('Something went wrong');
        }
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'tag_name' => trim($_POST['tag_name']),
                'tag_color' => trim($_POST['tag_color']),
                'name_err' => '',
                'color_err' => ''
            );

            if(empty($data['tag_name'])){
                $data['name_err'] = 'Please enter a name';
            }
            if(empty($data['tag_color'])){
                $data['color_err'] = 'Please enter a color';
            }

            if(empty($data['name_err']) && empty($data['color_err'])){
                $result = $this->tagModel->addTag($data);
                if($result){
                    foreach ($data['tag_ids'] as $tag) {
                        $this->tagModel->addTag2Post(
                          array(
                              'tag_id' => $tag,
                              'post_id' => $result
                          )
                        );
                    }
                    message('post_message', 'Tag Added');
                    redirect('tags');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/add', $data);
            }
        } else {
            $tags = $this->tagModel->getTags();
            $data = array(
                'title' => '',
                'content' => '',
                'tags' => $tags
            );
            $this->view('tags/add', $data);
        }
    }

}