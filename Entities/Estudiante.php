<?php

class Estudiante
{
    private $id;
    private $nombres;
    private $apellidos;
    private $edad;
    private $programaFK;
    private $programaNombre;

    public function __construct($id, $nombres, $apellidos, $edad, $programaFK, $programaNombre = null)
    {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
        $this->programaFK = $programaFK;
        $this->programaNombre = $programaNombre;
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

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
        return $this;
    }

    public function getProgramaFK()
    {
        return $this->programaFK;
    }

    public function setProgramaFK($programaFK)
    {
        $this->programaFK = $programaFK;
        return $this;
    }

    public function getProgramaNombre()
    {
        return $this->programaNombre;
    }

    public function setProgramaNombre($programaNombre)
    {
        $this->programaNombre = $programaNombre;
        return $this;
    }
}