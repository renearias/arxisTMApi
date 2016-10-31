<?php

namespace Multiservices\PayPayBundle\Bancos\Pichincha;

/**
 * Description of FormatoEntrada
 *
 * @author Rene Arias <renearias@arxis.la>
 */

use Multiservices\PayPayBundle\Entity\Facturas;
use MultiacademicoBundle\Entity\Pension;

class FormatoEntrada {
    /**
     *
     * @var string CO=Cobros PA=Pagos
     */
    private $codigoorientacion="CO"; 
    /**
     *
     * @var string codigo del cliente
     */
    private $contrapartida; 
    /**
     *
     * @var string
     */
    private $moneda="USD"; 
    /**
     *
     * @var integer
     */
    private $valor="";
    /**
     *
     * @var string CTA=cuenta, EFE=Efectivo, CHQ=cheque
     */
    private $formaDeCobroPago="";
    /**
     *
     * @var string CTA=Credito/DebitoCuenta
     */
    private $tipoDeCuenta; 
    /**
     *
     * @var string
     */
    private $numeroDeCuenta;
    /**
     *
     * @var string
     */
    private $referencia;
    /**
     *
     * @var string C=Cedula, R=Ruc, P=Pasaporte, N=No Dispoible
     */
    private $tipoIdCliente="N";
    /**
     *
     * @var string
     */
    private $numeroIdCliente;
    /**
     *
     * @var string
     */
    private $nombreCliente;
    
    /**
     *
     * @var string
     */
    private $baseImponible;
    
    
    public function getCodigoorientacion() {
        return $this->codigoorientacion;
    }

    public function getContrapartida() {
        return $this->contrapartida;
    }

    public function getMoneda() {
        return $this->moneda;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getFormaDeCobroPago() {
        return $this->formaDeCobroPago;
    }

    public function getTipoDeCuenta() {
        return $this->tipoDeCuenta;
    }

    public function getNumeroDeCuenta() {
        return $this->numeroDeCuenta;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function getTipoIdCliente() {
        return $this->tipoIdCliente;
    }

    public function getNumeroIdCliente() {
        return $this->numeroIdCliente;
    }

    public function getNombreCliente() {
        return $this->nombreCliente;
    }
    
    public function getBaseImponible() {
        return $this->baseImponible;
    }

    public function setCodigoorientacion($codigoorientacion) {
        $this->codigoorientacion = $codigoorientacion;
        return $this;
    }

    public function setContrapartida($contrapartida) {
        $this->contrapartida = $contrapartida;
        return $this;
    }

    public function setMoneda($moneda) {
        $this->moneda = $moneda;
        return $this;
    }

    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    public function setFormaDeCobroPago($formaDeCobroPago) {
        $this->formaDeCobroPago = $formaDeCobroPago;
        return $this;
    }

    public function setTipoDeCuenta($tipoDeCuenta) {
        $this->tipoDeCuenta = $tipoDeCuenta;
        return $this;
    }

    public function setNumeroDeCuenta($numeroDeCuenta) {
        $this->numeroDeCuenta = $numeroDeCuenta;
        return $this;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
        return $this;
    }

    public function setTipoIdCliente($tipoIdCliente) {
        $this->tipoIdCliente = $tipoIdCliente;
        return $this;
    }

    public function setNumeroIdCliente($numeroIdCliente) {
        $this->numeroIdCliente = $numeroIdCliente;
        return $this;
    }

    public function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
        return $this;
    }
    //llenado para recaudacion
    public function llenarDesdeFactura(Pension $pension) {
        
        $this->setCodigoorientacion("CO"); // CO=Cobros PA=Pagos
        $this->setContrapartida($pension->getEstudiante()->getId());
        $this->setMoneda("USD"); //USD=dolar
        $this->setValor(str_pad($pension->getFactura()->saldoAPagar()*100, 13, "0", STR_PAD_LEFT));
        $this->setFormaDeCobroPago("REC");
        $this->setTipoDeCuenta('');
        $this->setNumeroDeCuenta('');
        $this->setReferencia(substr($pension->getInfo(),0,40));
        $this->setTipoIdCliente('N');
        //$this->setNumeroIdCliente($pension->getFactura()->getIdcliente()->getCedula());
        $this->setNumeroIdCliente('');
        $this->setNombreCliente($pension->getFactura()->getIdcliente()->getRepresentante());
        //$this->baseImponible=$this->getValor();
        $this->baseImponible='';
        return true;
    }
    
    public function devolverString() {
        
        $tabulador="\t";
        $string=
            $this->getCodigoorientacion().$tabulador.
            $this->getContrapartida().$tabulador.
            $this->getMoneda().$tabulador.
        $this->getValor().$tabulador.
        $this->getFormaDeCobroPago().$tabulador.
        $this->getTipoDeCuenta().$tabulador.
        $this->getNumeroDeCuenta().$tabulador.
        $this->getReferencia().$tabulador.
        $this->getTipoIdCliente().$tabulador.
        $this->getNumeroIdCliente().$tabulador.
        $this->getNombreCliente().$tabulador.
        $this->getBaseImponible();
        
        return $string;
    }
        
}
