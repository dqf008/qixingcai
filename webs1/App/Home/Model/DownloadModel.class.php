<?php
namespace Home\Model;
use Think\Model;
class DownloadModel extends Model  {
protected $tableName = 'bet'; 

/**
 *name:用户数据导出操作
 * 
 */
public function getDate($data){

//导出格式
    $xlsCell  = array(
        array('id','ID'),
        array('qishu','期数'),
        array('did','订单号'),
        array('username','用户名称'),
        array('mingxi_1','玩法类型'),
        array('mingxi_2','号码'),
        array('money','下注金额'),
        array('addtime','下注时间'),
       
    );         
    $xlsName='下注数据';
    $this->exportExcel($xlsName,$xlsCell,$data);//$xlsName(文件名称) $xlsCell(文件要导出的字段)  

}
   private function exportExcel($expTitle,$expCellName,$expTableData){  
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle.(date('Y-m-d',time()));//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
         $objPHPExcel->setActiveSheetIndex(0); //设置第一个工作表为活动工作表
         $objPHPExcel->getActiveSheet()->setTitle($expTitle); //设置工作表名称        
      
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'1', $expCellName[$i][1]); 
        } 
        // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+2), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }       

        ob_end_clean();//先清除缓存，刚开始用的时候这一句没有加上，结果excel打不开。分析是缓存乱码导致。
        header("Content-type: text/plain");
        header("Accept-Ranges: bytes");
        header("Content-Disposition: attachment; filename=".$fileName.".xls");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header("Pragma: no-cache" );
        header("Expires: 0" ); 
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');     
        $objWriter->save('php://output');   

    } 




}