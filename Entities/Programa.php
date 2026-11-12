<?php

class Programa
{
    private $id;
    private $nombre;
    private $estado;

    public function __construct($id, $nombre, $estado = 1)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
}
