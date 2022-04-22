<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Uf;
use stdClass;

class PatientCtrl extends BaseController
{
     
    function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    function validaCns($cns)
    {
        $cns = preg_replace('/[^0-9]/', '', $cns);
        if(mb_strlen($cns) !=15){
            return false;
        }else{
            $firt_number = substr($cns,0,1);
            if(in_array($firt_number,array('1','2'))){
                $resultado = null;
                $soma = null;
                $i = 0;
                $p = 15;
                
                while($i <= 10){
                    $soma += (substr($cns,$i,1) * $p);
                    $i++;
                    $p--;
                }
                $resto = $soma % 11;
                $dv = 11-$resto;
                if($dv == 11){
                    $dv = 0;
                }

                if($dv == 10){
                    $resultado = null;
                    $soma = null;
                    $i = 0;
                    $p = 15;
                    
                    while($i <= 10){
                        $soma += (substr($cns,$i,1) * $p);
                        $i++;
                        $p--;
                    }
                    $soma = $soma + 2;
                    $resto = $soma % 11;
                    $dv = 11-$resto;
                    $resultado = substr($cns,0,11)."001".$dv;
                }else{
                    $resultado = substr($cns,0,11)."000".$dv;
                }
                if($cns != $resultado){
                    return false;
                }else{
                    return true;
                }
            }elseif(in_array($firt_number,array('7','8','9'))){
                $resultado = null;
                $soma = null;
                $i = 0;
                $p = 15;
                while($i <= 14){
                    $soma += (substr($cns,$i,1) * $p);
                    $i++;
                    $p--;
                   
                }
                $resto = $soma % 11;
                if($resto != 0){
                    return false;
                }else{
                    return true;
                }
            }else{
                return false;
            }
        }
    }
    public function index()
    {
        $permissao = true;
        if($permissao){
            $filtros = new stdClass();
            $msg = null;
            $msg_erro   = null;
            $patient    = new stdClass();
            $adress    = new stdClass();
            $contact    = new stdClass();
            $filtros    = new stdClass();
            $patient->id        = ((isset($this->request->patient_id)) ? $this->request->patient_id : null);
            $patient->pname         = ((isset($this->request->pname)) ? strtoupper($this->request->pname) : null);
            $patient->pphoto        = ((isset($this->request->pphoto)) ? $this->request->pphoto : null);
            $patient->pnamesocial   = ((isset($this->request->pnamesocial)) ? strtoupper($this->request->pnamesocial) : null);
            $patient->pmother   = ((isset($this->request->pmother)) ? strtoupper($this->request->pmother) : null);
            $patient->pfather   = ((isset($this->request->pfather)) ? strtoupper($this->request->pfather) : null);
            $patient->pbirth    = ((isset($this->request->pbirth)) ? $this->request->pbirth : null);
            $patient->pcpf      = ((isset($this->request->pcpf)) ? $this->request->pcpf : null);
            $patient->pcns      = ((isset($this->request->pcns)) ? $this->request->pcns : null);
            $patient->pnr_adress = ((isset($this->request->pnr_adress)) ? strtoupper($this->request->pnr_adress) : null);
            $patient->pcomplement = ((isset($this->request->pcomplement)) ? strtoupper($this->request->pcomplement) : null);
            $patient->pobs      = ((isset($this->request->pobs)) ? $this->request->pobs : null);

            $patient->pphone    = ((isset($this->request->pphone)) ? $this->request->pphone : null);
            $patient->pemail    = ((isset($this->request->pemail)) ? $this->request->pemail : null);

            $adress->id            = ((isset($this->request->id)) ? $this->request->id : null);
            $adress->cep           = ((isset($this->request->cep)) ? $this->request->cep : null);
            $adress->logradouro    = ((isset($this->request->logradouro)) ? strtoupper($this->request->logradouro) : null);
            $adress->bairro        = ((isset($this->request->bairro)) ? strtoupper(   $this->request->bairro) : null);
            $adress->cidade        = ((isset($this->request->cidade)) ? strtoupper($this->request->cidade) : null);
            $adress->uf            = ((isset($this->request->uf)) ? strtoupper($this->request->uf) : null);
            
            $filtros->acao = ((isset($this->request->acao)) ? $this->request->acao : null);
            $ufs = model(Uf::class); //$userModel = model(User::class);
            $data = [
                'msg' => null,
                'filtros' => $filtros,
                'msg_erro' => null,
                'patient' => $patient,
                'adress' => $adress,
                'uf' => $ufs->findAll()
            ];
            return $this->setPage('Cadastro de Paciente','patient/paciente',$data);
            //return view('patient/paciente',$data);
        }else{
            return view('default/acessonegado');
        }
        
    }
}
