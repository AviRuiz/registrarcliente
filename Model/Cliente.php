<?php
include "config.php";
class Cliente
{
    private $pdo;

    public $cliente;
    public $nombre;
    public $direccion;
    

    public function __construct()
    {
        try {
            $this->pdo = Conexion::Conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function MostrarCliente()
    {
        try {
            $sql = "SELECT * FROM tb_cliente order by cliente desc";
            $result = $this->pdo->query($sql);
            return $result->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarCliente($data)
    {
        try {
            $sql = $this->pdo->prepare("INSERT INTO tb_cliente(nombre,direccion) VALUES(?,?)");
            $sql->execute(
                array(
                    $data->nombre,
                    $data->direccion,
               
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarCliente($data)
    {
        try {
            $sql = $this->pdo->prepare("DELETE FROM tb_cliente where cliente = ?");
            $sql->execute(
                array(
                    $data->cliente
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EditarCliente($data)
    {
        try {
            $sql = $this->pdo->prepare("UPDATE tb_cliente SET nombre=?,direccion=? where cliente=?");
            $sql->execute(
                array(
                    $data->nombre,
                    $data->direccion,
                    $data->cliente
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
