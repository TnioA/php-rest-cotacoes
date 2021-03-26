<?php
    namespace App\Service;
    use App\Model\CoinModel;

    class CoinService
    {
        public function __construct() { }

        public function GetAll()
        {
            return $this->GetCoinsFromMsn();
        }

        public function GetById(int $id = null)
        {
            throw new \Exception("Method are not implemented!");
        }

        private function GetCoinsFromFinanceOne()
        {
            ini_set('default_charset','UTF-8');
            $html_font = file_get_contents('https://financeone.com.br');
    
            $get_box1 = explode("<div class='stocks lessContent'>", $html_font);
            $get_box2 = explode("<button type='button' id='moreCurrency'>Mais</button>", $get_box1[1]);
            $moedas_box = $get_box2[0];
            $moedas_box = explode('<div>', $moedas_box);
    
            $moedas = array('moedas' => array());
    
            for ($i=1; $i < count($moedas_box); $i++) { 
                //img-moeda
                $get_flag = explode('src="', $moedas_box[$i]);
                $get_flag = explode('">', $get_flag[1]);
    
                //nome-moeda
                $get_name = explode('<p><b>', $moedas_box[$i]);
                $get_name = explode("</b></p>", $get_name[1]);
    
                //valor-moeda
                $get_value = explode('<p>', $get_name[1]);
                $get_value = explode('</p>', $get_value[1]);
                
                if(is_numeric($get_value[0][2])){
                    $aux = $get_value[0];
                }else{
                    $aux = 'R$0,00';
                }
                
                array_push($moedas['moedas'], new CoinModel($get_name[0], $get_flag[0], $aux));
            }
        
            return $moedas;
        }

        private function GetCoinsFromMsn()
        {
            ini_set('default_charset','UTF-8');
            $html_font = file_get_contents('https://www.msn.com/pt-br/dinheiro/cotacao-do-dolar');
            
            $get_box1 = explode('<div class="mjrcurrncsrow mjcurrncs-data">', $html_font);
            $get_box2 = explode('<div class="ad" id="currncs-ad">', $get_box1[1]);
            $moedas_box = $get_box2[0];
            $moedas_box = explode('<div class="mcrow">', $moedas_box);
    
            //echo(count($moedas_box));
    
            $moedas = array();
    
            
            for ($i=1; $i < count($moedas_box); $i++) { 
                //nome-moeda
                $get_name = explode('<span class="cnvrsncol">', $moedas_box[$i]);
                $get_name = explode(")'>", $get_name[0]);
                $get_name = explode('</p></span>', $get_name[1]);
    
                //valor-moeda
                $get_value = explode('<span class="pricecol">', $moedas_box[$i]);
                $get_value = explode('</p></span>', $get_value[1]);
                $get_value = explode('">', $get_value[0]);
                
                //tratamento
                $get_value[1] = str_replace(',', '.', $get_value[1]);
    
                if(strpos($get_name[0], 'Estados Unidos')){
                    $get_flag = 'usa';
                }
                if(strpos($get_name[0], 'Europa')){
                    $get_flag = 'european_union';
                }
                if(strpos($get_name[0], 'Argentina')){
                    $get_flag = 'argentina';
                }
                if(strpos($get_name[0], 'Reino Unido')){
                    $get_flag = 'united_kingdom';
                }
                if(strpos($get_name[0], 'xico')){
                    $get_flag = 'mexico';
                }
                if(strpos($get_name[0], 'Chile')){
                    $get_flag = 'chile';
                }
                if(strpos($get_name[0], 'Uruguai')){
                    $get_flag = 'uruguay';
                }
                if(strpos($get_name[0], 'Jap')){
                    $get_flag = 'japan';
                }
                if(strpos($get_name[0], 'China')){
                    $get_flag = 'china';
                }
                if(strpos($get_name[0], '(Su')){
                    $get_flag = 'switzerland';
                }
                if(strpos($get_name[0], 'frica do Sul')){
                    $get_flag = 'south_africa';
                }
                if(strpos($get_name[0], '(Austr')){
                    $get_flag = 'australia';
                }
                if(strpos($get_name[0], 'Canad')){
                    $get_flag = 'canada';
                }
                if(strpos($get_name[0], 'Cingapura')){
                    $get_flag = 'singapore';
                }
    
                array_push($moedas, 
                new CoinModel($get_name[0], 
                'http://restcotacoes.herokuapp.com/assets/icons/'.$get_flag.'.svg', 
                'R$'.number_format((float)$get_value[1], 2, '.', '')));
            }
    
            return $moedas;
        }

        private function GetFromBase(){
            
        }

        private function InsertIntoBase(){
            
        }
    }
?>