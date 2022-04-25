<?php

namespace App\Controllers;

use App\Models\PersonaModel;

class DataBase extends BaseController
{
    public function __construct()
    {
        helper('form');
    }
    public function formulario()
    {
        $estructura = view('templates/header') . view('formulario') . view('templates/footer');
        return ($estructura);
    }
    public function guardar()
    {
        $personaModel = new PersonaModel($db);
        $request = \Config\Services::request();
        $data = array(
            'CI' => $request->getPostGet('ci'),
            'NOMBRE' => $request->getPostGet('nombre'),
            'APELLIDO' => $request->getPostGet('apellido'),
            'FECHA_NACIMIENTO' => $request->getPostGet('fecha_nacimiento'),
            'DEPARTAMENTO' => $request->getPostGet('departamento')
        );
        if ($personaModel->insert($data) === false) {
            var_dump($personaModel->errors());
        }
        $persona = $personaModel->findAll();
        $persona = array('personas' => $persona);
        //var_dump($persona);

        $estructura = view('templates/header') . view('inicio', $persona) . view('templates/footer');
        return ($estructura);
    }
    public function guardar2()
    {
        $personaModel = new PersonaModel($db);
        $request = \Config\Services::request();
        $data = array(
            'CI' => $request->getPostGet('ci'),
            'NOMBRE' => $request->getPostGet('nombre'),
            'APELLIDO' => $request->getPostGet('apellido'),
            'FECHA_NACIMIENTO' => $request->getPostGet('fecha_nacimiento'),
            'DEPARTAMENTO' => $request->getPostGet('departamento')
        );
        if ($request->getPostGet('id')) {
            $data['id'] = $request->getPostGet('id');
        }
              if ($personaModel->save($data) === false) {
            var_dump($personaModel->errors());
        }
        $persona = $personaModel->findAll();
        $persona = array('personas' => $persona);
        //var_dump($persona);

        $estructura = view('templates/header') . view('inicio', $persona) . view('templates/footer');
        return ($estructura);
    }
    public function index()
    {
        //$request=\Config\Services::request();
        //$saludo=$request->getPost('saludo');
        //echo $saludo;

        $personaModel = new PersonaModel($db);
        //$persona=$personaModel->find([6157061]);
        $persona = $personaModel->findAll();
        $persona = array('personas' => $persona);
        //var_dump($persona);

        $estructura = view('templates/header') . view('inicio', $persona) . view('templates/footer');
        return ($estructura);
    }

    public function editar()
    {
        $personaModel = new PersonaModel($db);
        $request = \Config\Services::request();
        $id = $request->getPostGet('id');

        $personas = $personaModel->find($id);
        $personas = array('persona' => $personas);
        //var_dump($persona);

        $estructura = view('templates/header') . view('formulario2', $personas) . view('templates/footer');
        return ($estructura);
    }
    public function borrar()
    {
        $personaModel = new PersonaModel($db);
        $request = \Config\Services::request();
        $id = $request->getPostGet('id');

       $personaModel->delete($id);
        $personas = $personaModel->findAll();
        $personas=array('personas'=>$personas);
        //var_dump($persona);

        $estructura = view('templates/header') . view('inicio', $personas) . view('templates/footer');
        return ($estructura);
    }
}
