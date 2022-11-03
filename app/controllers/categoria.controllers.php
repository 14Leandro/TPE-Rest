<?php
require_once './app/models/categoria.model.php';
require_once './app/views/categoria.view.php';

class TaskApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getCategorias($params = null) {
        $categorias = $this->model->getAll();
        $this->view->response($categorias);
    }

    public function getCategorias($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $categoria = $this->model->get($id);

        // si no existe devuelvo 404
        if ($categoria)
            $this->view->response($categoria);
        else 
            $this->view->response("La categoria con el id=$id no existe", 404);
    }

    public function deleteCategoria($params = null) {
        $id = $params[':ID'];

        $categoria = $this->model->get($id);
        if ($categoria) {
            $this->model->delete($id);
            $this->view->response($categoria);
        } else 
            $this->view->response("La categoria con el id=$id no existe", 404);
    }

    public function insertCategoria($params = null) {
        $categoria = $this->getData();

        if (empty($categoria->nombre) || empty($categoria->imagen)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($categoria->titulo, $categoria->descripcion, $categoria->prioridad);
            $categoria = $this->model->get($id);
            $this->view->response($categoria, 201);
        }
    }


}