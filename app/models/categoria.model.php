<?php

class CategoriaModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de categorias completa.
     */
    public function getAll() {

        // Ejecuto la sentencia
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();

        // Obtengo los resultados
        $categorias = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $categorias;
    }

    // Devuelve una categoria seleccionada por su id
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM categorias WHERE id = ?");
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        
        return $categoria;
    }

    /**
     * Inserta una categoria en la base de datos.
     */
    public function insert($nombre, $imagen) {
        $query = $this->db->prepare("INSERT INTO task (nombre, categoria) VALUES (?, ?)");
        $query->execute([$nombre, $imagen]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina una categoria seleccionada por su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id = ?');
        $query->execute([$id]);
    }
}