<?php

/*
 * + --------------------------------------------------------- +
 * |  Software:	Paginador - clase PHP para paginar registros   |
 * |   Versión:	1.0											   |
 * |  Licencia:	Distribuido de forma libre					   |
 * |     Autor:	Jaisiel Delance								   |
 * | Sitio Web:	http://www.dlancedu.com						   |
 * + --------------------------------------------------------- +
 *
 */


class Pager
{
    private $_data;
    private $_pagination;
    
    public function __construct() {
        $this->_data = array();
        $this->_pagination = array();
    }
    
    public function paginate($query, $page = false, $limit = false, $pagecion = false)
    {
        if($limit && is_numeric($limit)){
            $limit = $limit;
        } else {
            $limit = 10;
        }
        
        if($page && is_numeric($page)){
            $page = $page;
            $inicio = ($page - 1) * $limit;
        } else {
            $page = 1;
            $inicio = 0;
        }
        
        
        $registros = count($query);
        $total = ceil($registros / $limit);
        $this->_data = array_slice($query, $inicio, $limit);
               
        $pagecion = array();
        $pagecion['present'] = $page;
        $pagecion['total'] = $total;
        
        if($page > 1){
            $pagecion['first'] = 1;
            $pagecion['previous'] = $page - 1;
        } else {
            $pagecion['first'] = '';
            $pagecion['previous'] = '';
        }
        
        if($page < $total){
            $pagecion['last'] = $total;
            $pagecion['next'] = $page + 1;
        } else {
            $pagecion['last'] = '';
            $pagecion['next'] = '';
        }
        
        $this->_pagination = $pagecion;
		$this->_rangePagination($pagecion);
        
        return $this->_data;
    }
    
    private function _rangePagination($limit = false)
    {
        if($limit && is_numeric($limit)){
            $limit = $limit;
        } else {
            $limit = 10;
        }
        
        $total_paginas = $this->_pagination['total'];
        $page_seleccionada = $this->_pagination['present'];
        $rango = ceil($limit / 2);
        $pages = array();
        
        $rango_derecho = $total_paginas - $page_seleccionada;
        
        if($rango_derecho < $rango){
            $resto = $rango - $rango_derecho;
        } else {
            $resto = 0;
        }
        
        $rango_izquierdo = $page_seleccionada - ($rango + $resto);
        
        for($i = $page_seleccionada; $i > $rango_izquierdo; $i--){
            if($i == 0){
                break;
            }
            
            $pages[] = $i;
        }
        
        sort($pages);
        
        if($page_seleccionada < $rango){
            $rango_derecho = $limit;
        } else {
            $rango_derecho = $page_seleccionada + $rango;
        }
        
        for($i = $page_seleccionada + 1; $i <= $rango_derecho; $i++){
            if($i > $total_paginas){
                break;
            }
            
            $pages[] = $i;
        }
        
        $this->_pagination['rank'] = $pages;
        
        return $this->_pagination;
        
    }

	public function getView($vista, $link = false)
	{
		$rutaView = ROOT . 'views' . DS . '_pager' . DS . $vista . '.php';
		
		if($link)
		$link = BASE_URL . $link . '/';
		
		if(is_readable($rutaView)){
			ob_start();
			
			include $rutaView;
			
			$contenido = ob_get_contents();
			
			ob_end_clean();
			
			return $contenido;
		}
		
		throw new Exception('Error de paginacion');		
	}
}

?>
