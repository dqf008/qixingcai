<?php if (!defined('THINK_PATH')) exit();?><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>七星彩四码销售系统</title>
<style type="text/css">
<!--
body,td,th {
    font-family: 宋体;
    font-size: 14px;
    color: #333;
}
body {
    margin-left: 20px;
    margin-top: 20px;
    margin-right: 20px;
    margin-bottom: 20px;
}
a.BtnStyle:link, a.BtnStyle:visited, a.BtnStyle:active
{
    color: #EEE;
    display:block;
    width:72px;
    height:28px;
    line-height:30px;
    text-decoration:none;
    background:url(/Public/index/BtnForm.png) no-repeat left top;
    text-align:center;
    font-family: 黑体;
    font-size: 15px;
}
a.BtnStyle:hover
{
    color: #EEE;
    background-position:right top;
    font-family: 黑体;
    font-size: 15px;
}
.TitleColor {
    font-family: "宋体";
    font-size: 14px;
    color: #FFF;
}
-->
</style>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
</head>

<body>
<form id="form1" name="form1">
<table width="920" border="0" cellspacing="0" cellpadding="0">

  <tbody><tr>
    <td height="28" colspan="2" align="center" background="/Public/index/TitleBar.png" class="TitleColor">新建一期</td>
    </tr>
  <tr>
    <td width="80" height="30">年份：</td>
    <td width="840" height="30"><table width="300" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <?php if($data1['zt_status'] == '1'): ?><tr>
        <td width="120" height="28"><?php echo ($data1['m_year']); ?></td>
        <td width="60" height="28" align="center">期号：</td>
        <td width="120" height="28"><?php echo ($data1['qishu']); ?></td>
        <td width="100"><input name="PeriodID" type="hidden" id="PeriodID" value="<?php echo ($data1['id']); ?>"></td>
      </tr>
     
      <?php else: ?>
      <tr>
        <td width="120" height="28"><select name="Year" id="Year">
          <option value="2018" selected="">2018</option>
          <option value="2019">2019</option>
        </select></td>
        <td width="60" height="28" align="center">期号：</td>
        <td width="120" height="28"><input name="Period" type="text" id="Period" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" value="<?php echo ($data1['qishu']); ?>" size="10" maxlength="8"></td>
      </tr><?php endif; ?>
    </tbody></table></td>
  </tr>
  <tr>
    <td width="80" height="30">开盘时间：</td>
    <td width="840" height="30"><select name="StartYear" id="StartYear">
      <option value="2018" selected="">2018</option>
      <option value="2019">2019</option>
    </select>
年&nbsp;
<select name="StartMonth" id="StartMonth">
    <option value="1" <?php if($m_openings[1]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_openings[1]==2){ echo 'selected';} ?>>2</option> 
    <option value="3" <?php if($m_openings[1]==3){ echo 'selected';} ?>>3</option> 
    <option value="4" <?php if($m_openings[1]==4){ echo 'selected';} ?>>4</option> 
    <option value="5" <?php if($m_openings[1]==5){ echo 'selected';} ?>>5</option>
    <option value="6" <?php if($m_openings[1]==6){ echo 'selected';} ?>>6</option> 
    <option value="7" <?php if($m_openings[1]==7){ echo 'selected';} ?>>7</option>
    <option value="8" <?php if($m_openings[1]==8){ echo 'selected';} ?>>8</option> 
    <option value="9" <?php if($m_openings[1]==9){ echo 'selected';} ?>>9</option>  
    <option value="10" <?php if($m_openings[1]==10){ echo 'selected';} ?>>10</option>  
    <option value="11" <?php if($m_openings[1]==11){ echo 'selected';} ?>>11</option>  
    <option value="12" <?php if($m_openings[1]==12){ echo 'selected';} ?>>12</option>
</select>
月&nbsp;
<select name="StartDay" id="StartDay">
<option value="1" <?php if($m_openings[2]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_openings[2]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_openings[2]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_openings[2]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_openings[2]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_openings[2]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_openings[2]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_openings[2]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_openings[2]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_openings[2]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_openings[2]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_openings[2]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_openings[2]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_openings[2]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_openings[2]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_openings[2]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_openings[2]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_openings[2]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_openings[2]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_openings[2]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_openings[2]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_openings[2]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_openings[2]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_openings[2]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_openings[2]==25){ echo 'selected';} ?> >25</option>  
    <option value="26" <?php if($m_openings[2]==26){ echo 'selected';} ?> >26</option> 
    <option value="27" <?php if($m_openings[2]==27){ echo 'selected';} ?> >27</option> 
    <option value="28" <?php if($m_openings[2]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_openings[2]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_openings[2]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_openings[2]==31){ echo 'selected';} ?> >31</option>
</select>
日&nbsp;&nbsp;
<select name="StartHour" id="StartHour">
    <option value="0" <?php if($m_openings1[0]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_openings1[0]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_openings1[0]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_openings1[0]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_openings1[0]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_openings1[0]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_openings1[0]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_openings1[0]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_openings1[0]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_openings1[0]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_openings1[0]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_openings1[0]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_openings1[0]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_openings1[0]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_openings1[0]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_openings1[0]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_openings1[0]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_openings1[0]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_openings1[0]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_openings1[0]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_openings1[0]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_openings1[0]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_openings1[0]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_openings1[0]==23){ echo 'selected';} ?> >23</option> 
</select>
时&nbsp;
<select name="StartMinute" id="StartMinute">
    <option value="0" <?php if($m_openings1[1]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_openings1[1]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_openings1[1]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_openings1[1]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_openings1[1]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_openings1[1]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_openings1[1]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_openings1[1]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_openings1[1]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_openings1[1]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_openings1[1]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_openings1[1]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_openings1[1]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_openings1[1]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_openings1[1]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_openings1[1]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_openings1[1]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_openings1[1]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_openings1[1]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_openings1[1]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_openings1[1]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_openings1[1]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_openings1[1]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_openings1[1]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_openings1[1]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_openings1[1]==25){ echo 'selected';} ?> >25</option> 
    <option value="26" <?php if($m_openings1[1]==26){ echo 'selected';} ?> >26</option>
    <option value="27" <?php if($m_openings1[1]==27){ echo 'selected';} ?> >27</option>
    <option value="28" <?php if($m_openings1[1]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_openings1[1]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_openings1[1]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_openings1[1]==31){ echo 'selected';} ?> >31</option> 
    <option value="32" <?php if($m_openings1[1]==32){ echo 'selected';} ?> >32</option> 
    <option value="33" <?php if($m_openings1[1]==33){ echo 'selected';} ?> >33</option> 
    <option value="34" <?php if($m_openings1[1]==34){ echo 'selected';} ?> >34</option> 
    <option value="35" <?php if($m_openings1[1]==35){ echo 'selected';} ?> >35</option> 
    <option value="36" <?php if($m_openings1[1]==36){ echo 'selected';} ?> >36</option> 
    <option value="37" <?php if($m_openings1[1]==37){ echo 'selected';} ?> >37</option> 
    <option value="38" <?php if($m_openings1[1]==38){ echo 'selected';} ?> >38</option> 
    <option value="39" <?php if($m_openings1[1]==39){ echo 'selected';} ?> >39</option> 
    <option value="40" <?php if($m_openings1[1]==40){ echo 'selected';} ?> >40</option> 
    <option value="41"  <?php if($m_openings1[1]==41){ echo 'selected';} ?> >41</option>  
    <option value="42" <?php if($m_openings1[1]==42){ echo 'selected';} ?> >42</option>  
    <option value="43" <?php if($m_openings1[1]==43){ echo 'selected';} ?> >43</option> 
    <option value="44" <?php if($m_openings1[1]==44){ echo 'selected';} ?> >44</option>
    <option value="45" <?php if($m_openings1[1]==45){ echo 'selected';} ?> >45</option>  
    <option value="46" <?php if($m_openings1[1]==46){ echo 'selected';} ?> >46</option> 
    <option value="47" <?php if($m_openings1[1]==47){ echo 'selected';} ?> >47</option>
    <option value="48" <?php if($m_openings1[1]==48){ echo 'selected';} ?> >48</option> 
    <option value="49" <?php if($m_openings1[1]==49){ echo 'selected';} ?> >49</option>
    <option value="50" <?php if($m_openings1[1]==50){ echo 'selected';} ?> >50</option> 
    <option value="51" <?php if($m_openings1[1]==51){ echo 'selected';} ?> >51</option>  
    <option value="52" <?php if($m_openings1[1]==52){ echo 'selected';} ?> >52</option>  
    <option value="53" <?php if($m_openings1[1]==53){ echo 'selected';} ?> >53</option> 
    <option value="54" <?php if($m_openings1[1]==54){ echo 'selected';} ?> >54</option> 
    <option value="55" <?php if($m_openings1[1]==55){ echo 'selected';} ?> >55</option> 
    <option value="56" <?php if($m_openings1[1]==56){ echo 'selected';} ?> >56</option> 
     <option value="57" <?php if($m_openings1[1]==57){ echo 'selected';} ?> >57</option> 
      <option value="58" <?php if($m_openings1[1]==58){ echo 'selected';} ?> >58</option>
        <option value="59" <?php if($m_openings1[1]==59){ echo 'selected';} ?> >59</option>
</select>
分 </td>
  </tr>
  <tr>
    <td width="80" height="30">封盘时间：</td>
    <td width="840" height="30"><label>
      <select name="CloseYear" id="CloseYear">
        <option value="2018" selected="">2018</option>
          <option value="2019">2019</option>
      </select>
    年&nbsp;
    <select name="CloseMonth" id="CloseMonth">
      <option value="1" <?php if($m_seals[1]==1){ echo 'selected';} ?> >1</option> 
      <option value="2" <?php if($m_seals[1]==2){ echo 'selected';} ?>>2</option> 
      <option value="3" <?php if($m_seals[1]==3){ echo 'selected';} ?>>3</option> 
      <option value="4" <?php if($m_seals[1]==4){ echo 'selected';} ?>>4</option> 
      <option value="5" <?php if($m_seals[1]==5){ echo 'selected';} ?>>5</option>
      <option value="6" <?php if($m_seals[1]==6){ echo 'selected';} ?>>6</option> 
      <option value="7" <?php if($m_seals[1]==7){ echo 'selected';} ?>>7</option>
      <option value="8" <?php if($m_seals[1]==8){ echo 'selected';} ?>>8</option> 
      <option value="9" <?php if($m_seals[1]==9){ echo 'selected';} ?>>9</option>  
      <option value="10" <?php if($m_seals[1]==10){ echo 'selected';} ?>>10</option>  
      <option value="11" <?php if($m_seals[1]==11){ echo 'selected';} ?>>11</option>  
      <option value="12" <?php if($m_seals[1]==12){ echo 'selected';} ?>>12</option>
    </select> 
    月&nbsp;
    <select name="CloseDay" id="CloseDay">
    <option value="1" <?php if($m_seals[2]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_seals[2]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_seals[2]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_seals[2]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_seals[2]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_seals[2]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_seals[2]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_seals[2]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_seals[2]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_seals[2]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_seals[2]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_seals[2]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_seals[2]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_seals[2]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_seals[2]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_seals[2]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_seals[2]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_seals[2]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_seals[2]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_seals[2]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_seals[2]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_seals[2]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_seals[2]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_seals[2]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_seals[2]==25){ echo 'selected';} ?> >25</option>  
    <option value="26" <?php if($m_seals[2]==26){ echo 'selected';} ?> >26</option> 
    <option value="27" <?php if($m_seals[2]==27){ echo 'selected';} ?> >27</option> 
    <option value="28" <?php if($m_seals[2]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_seals[2]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_seals[2]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_seals[2]==31){ echo 'selected';} ?> >31</option>
    </select> 
    日&nbsp;&nbsp;
    <select name="CloseHour" id="CloseHour">
     <option value="0" <?php if($m_seals1[0]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_seals1[0]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_seals1[0]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_seals1[0]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_seals1[0]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_seals1[0]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_seals1[0]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_seals1[0]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_seals1[0]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_seals1[0]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_seals1[0]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_seals1[0]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_seals1[0]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_seals1[0]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_seals1[0]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_seals1[0]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_seals1[0]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_seals1[0]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_seals1[0]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_seals1[0]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_seals1[0]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_seals1[0]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_seals1[0]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_seals1[0]==23){ echo 'selected';} ?> >23</option> 
    </select>
    时&nbsp; 
    <select name="CloseMinute" id="CloseMinute">
    <option value="0" <?php if($m_seals1[1]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_seals1[1]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_seals1[1]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_seals1[1]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_seals1[1]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_seals1[1]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_seals1[1]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_seals1[1]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_seals1[1]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_seals1[1]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_seals1[1]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_seals1[1]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_seals1[1]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_seals1[1]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_seals1[1]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_seals1[1]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_seals1[1]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_seals1[1]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_seals1[1]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_seals1[1]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_seals1[1]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_seals1[1]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_seals1[1]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_seals1[1]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_seals1[1]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_seals1[1]==25){ echo 'selected';} ?> >25</option> 
    <option value="26" <?php if($m_seals1[1]==26){ echo 'selected';} ?> >26</option>
    <option value="27" <?php if($m_seals1[1]==27){ echo 'selected';} ?> >27</option>
    <option value="28" <?php if($m_seals1[1]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_seals1[1]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_seals1[1]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_seals1[1]==31){ echo 'selected';} ?> >31</option> 
    <option value="32" <?php if($m_seals1[1]==32){ echo 'selected';} ?> >32</option> 
    <option value="33" <?php if($m_seals1[1]==33){ echo 'selected';} ?> >33</option> 
    <option value="34" <?php if($m_seals1[1]==34){ echo 'selected';} ?> >34</option> 
    <option value="35" <?php if($m_seals1[1]==35){ echo 'selected';} ?> >35</option> 
    <option value="36" <?php if($m_seals1[1]==36){ echo 'selected';} ?> >36</option> 
    <option value="37" <?php if($m_seals1[1]==37){ echo 'selected';} ?> >37</option> 
    <option value="38" <?php if($m_seals1[1]==38){ echo 'selected';} ?> >38</option> 
    <option value="39" <?php if($m_seals1[1]==39){ echo 'selected';} ?> >39</option> 
    <option value="40" <?php if($m_seals1[1]==40){ echo 'selected';} ?> >40</option> 
    <option value="41"  <?php if($m_seals1[1]==41){ echo 'selected';} ?> >41</option>  
    <option value="42" <?php if($m_seals1[1]==42){ echo 'selected';} ?> >42</option>  
    <option value="43" <?php if($m_seals1[1]==43){ echo 'selected';} ?> >43</option> 
    <option value="44" <?php if($m_seals1[1]==44){ echo 'selected';} ?> >44</option>
    <option value="45" <?php if($m_seals1[1]==45){ echo 'selected';} ?> >45</option>  
    <option value="46" <?php if($m_seals1[1]==46){ echo 'selected';} ?> >46</option> 
    <option value="47" <?php if($m_seals1[1]==47){ echo 'selected';} ?> >47</option>
    <option value="48" <?php if($m_seals1[1]==48){ echo 'selected';} ?> >48</option> 
    <option value="49" <?php if($m_seals1[1]==49){ echo 'selected';} ?> >49</option>
    <option value="50" <?php if($m_seals1[1]==50){ echo 'selected';} ?> >50</option> 
    <option value="51" <?php if($m_seals1[1]==51){ echo 'selected';} ?> >51</option>  
    <option value="52" <?php if($m_seals1[1]==52){ echo 'selected';} ?> >52</option>  
    <option value="53" <?php if($m_seals1[1]==53){ echo 'selected';} ?> >53</option> 
    <option value="54" <?php if($m_seals1[1]==54){ echo 'selected';} ?> >54</option> 
    <option value="55" <?php if($m_seals1[1]==55){ echo 'selected';} ?> >55</option> 
    <option value="56" <?php if($m_seals1[1]==56){ echo 'selected';} ?> >56</option> 
     <option value="57" <?php if($m_seals1[1]==57){ echo 'selected';} ?> >57</option> 
      <option value="58" <?php if($m_seals1[1]==58){ echo 'selected';} ?> >58</option>
        <option value="59" <?php if($m_seals1[1]==59){ echo 'selected';} ?> >59</option>
    </select>
    分 </label></td>
  </tr>
  <tr>
    <td width="80" height="30">开奖时间：</td>
    <td width="840" height="30"><select name="AwardYear" id="AwardYear">
        <option value="2018" selected="">2018</option>
        <option value="2019">2019</option>
    </select>
年&nbsp;
<select name="AwardMonth" id="AwardMonth">
    <option value="1" <?php if($m_savetimes[1]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_savetimes[1]==2){ echo 'selected';} ?>>2</option> 
    <option value="3" <?php if($m_savetimes[1]==3){ echo 'selected';} ?>>3</option> 
    <option value="4" <?php if($m_savetimes[1]==4){ echo 'selected';} ?>>4</option> 
    <option value="5" <?php if($m_savetimes[1]==5){ echo 'selected';} ?>>5</option>
    <option value="6" <?php if($m_savetimes[1]==6){ echo 'selected';} ?>>6</option> 
    <option value="7" <?php if($m_savetimes[1]==7){ echo 'selected';} ?>>7</option>
    <option value="8" <?php if($m_savetimes[1]==8){ echo 'selected';} ?>>8</option> 
    <option value="9" <?php if($m_savetimes[1]==9){ echo 'selected';} ?>>9</option>  
    <option value="10" <?php if($m_savetimes[1]==10){ echo 'selected';} ?>>10</option>  
    <option value="11" <?php if($m_savetimes[1]==11){ echo 'selected';} ?>>11</option>  
    <option value="12" <?php if($m_savetimes[1]==12){ echo 'selected';} ?>>12</option>
</select>
月&nbsp;
<select name="AwardDay" id="AwardDay">
<option value="1" <?php if($m_savetimes[2]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_savetimes[2]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_savetimes[2]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_savetimes[2]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_savetimes[2]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_savetimes[2]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_savetimes[2]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_savetimes[2]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_savetimes[2]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_savetimes[2]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_savetimes[2]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_savetimes[2]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_savetimes[2]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_savetimes[2]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_savetimes[2]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_savetimes[2]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_savetimes[2]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_savetimes[2]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_savetimes[2]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_savetimes[2]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_savetimes[2]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_savetimes[2]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_savetimes[2]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_savetimes[2]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_savetimes[2]==25){ echo 'selected';} ?> >25</option>  
    <option value="26" <?php if($m_savetimes[2]==26){ echo 'selected';} ?> >26</option> 
    <option value="27" <?php if($m_savetimes[2]==27){ echo 'selected';} ?> >27</option> 
    <option value="28" <?php if($m_savetimes[2]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_savetimes[2]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_savetimes[2]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_savetimes[2]==31){ echo 'selected';} ?> >31</option>
</select>
日&nbsp;&nbsp;
<select name="AwardHour" id="AwardHour">
<option value="0" <?php if($m_savetimes1[0]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_savetimes1[0]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_savetimes1[0]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_savetimes1[0]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_savetimes1[0]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_savetimes1[0]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_savetimes1[0]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_savetimes1[0]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_savetimes1[0]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_savetimes1[0]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_savetimes1[0]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_savetimes1[0]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_savetimes1[0]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_savetimes1[0]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_savetimes1[0]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_savetimes1[0]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_savetimes1[0]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_savetimes1[0]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_savetimes1[0]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_savetimes1[0]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_savetimes1[0]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_savetimes1[0]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_savetimes1[0]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_savetimes1[0]==23){ echo 'selected';} ?> >23</option> 
</select>
时&nbsp;
<select name="AwardMinute" id="AwardMinute">
<option value="0" <?php if($m_savetimes1[1]==1){ echo 'selected';} ?> >0</option> 
    <option value="1" <?php if($m_savetimes1[1]==1){ echo 'selected';} ?> >1</option> 
    <option value="2" <?php if($m_savetimes1[1]==2){ echo 'selected';} ?> >2</option> 
    <option value="3" <?php if($m_savetimes1[1]==3){ echo 'selected';} ?> >3</option> 
    <option value="4" <?php if($m_savetimes1[1]==4){ echo 'selected';} ?> >4</option> 
    <option value="5" <?php if($m_savetimes1[1]==5){ echo 'selected';} ?> >5</option> 
    <option value="6" <?php if($m_savetimes1[1]==6){ echo 'selected';} ?> >6</option> 
    <option value="7" <?php if($m_savetimes1[1]==7){ echo 'selected';} ?> >7</option> 
    <option value="8" <?php if($m_savetimes1[1]==8){ echo 'selected';} ?> >8</option> 
    <option value="9" <?php if($m_savetimes1[1]==9){ echo 'selected';} ?> >9</option> 
    <option value="10" <?php if($m_savetimes1[1]==10){ echo 'selected';} ?> >10</option> 
    <option value="11" <?php if($m_savetimes1[1]==11){ echo 'selected';} ?> >11</option> 
    <option value="12" <?php if($m_savetimes1[1]==12){ echo 'selected';} ?> >12</option> 
    <option value="13" <?php if($m_savetimes1[1]==13){ echo 'selected';} ?> >13</option> 
    <option value="14" <?php if($m_savetimes1[1]==14){ echo 'selected';} ?> >14</option> 
    <option value="15" <?php if($m_savetimes1[1]==15){ echo 'selected';} ?> >15</option> 
    <option value="16" <?php if($m_savetimes1[1]==16){ echo 'selected';} ?> >16</option> 
    <option value="17" <?php if($m_savetimes1[1]==17){ echo 'selected';} ?> >17</option> 
    <option value="18" <?php if($m_savetimes1[1]==18){ echo 'selected';} ?> >18</option> 
    <option value="19" <?php if($m_savetimes1[1]==19){ echo 'selected';} ?> >19</option> 
    <option value="20" <?php if($m_savetimes1[1]==20){ echo 'selected';} ?> >20</option> 
    <option value="21" <?php if($m_savetimes1[1]==21){ echo 'selected';} ?> >21</option> 
    <option value="22" <?php if($m_savetimes1[1]==22){ echo 'selected';} ?> >22</option>
    <option value="23" <?php if($m_savetimes1[1]==23){ echo 'selected';} ?> >23</option> 
    <option value="24" <?php if($m_savetimes1[1]==24){ echo 'selected';} ?> >24</option> 
    <option value="25" <?php if($m_savetimes1[1]==25){ echo 'selected';} ?> >25</option> 
    <option value="26" <?php if($m_savetimes1[1]==26){ echo 'selected';} ?> >26</option>
    <option value="27" <?php if($m_savetimes1[1]==27){ echo 'selected';} ?> >27</option>
    <option value="28" <?php if($m_savetimes1[1]==28){ echo 'selected';} ?> >28</option> 
    <option value="29" <?php if($m_savetimes1[1]==29){ echo 'selected';} ?> >29</option> 
    <option value="30" <?php if($m_savetimes1[1]==30){ echo 'selected';} ?> >30</option> 
    <option value="31" <?php if($m_savetimes1[1]==31){ echo 'selected';} ?> >31</option> 
    <option value="32" <?php if($m_savetimes1[1]==32){ echo 'selected';} ?> >32</option> 
    <option value="33" <?php if($m_savetimes1[1]==33){ echo 'selected';} ?> >33</option> 
    <option value="34" <?php if($m_savetimes1[1]==34){ echo 'selected';} ?> >34</option> 
    <option value="35" <?php if($m_savetimes1[1]==35){ echo 'selected';} ?> >35</option> 
    <option value="36" <?php if($m_savetimes1[1]==36){ echo 'selected';} ?> >36</option> 
    <option value="37" <?php if($m_savetimes1[1]==37){ echo 'selected';} ?> >37</option> 
    <option value="38" <?php if($m_savetimes1[1]==38){ echo 'selected';} ?> >38</option> 
    <option value="39" <?php if($m_savetimes1[1]==39){ echo 'selected';} ?> >39</option> 
    <option value="40" <?php if($m_savetimes1[1]==40){ echo 'selected';} ?> >40</option> 
    <option value="41"  <?php if($m_savetimes1[1]==41){ echo 'selected';} ?> >41</option>  
    <option value="42" <?php if($m_savetimes1[1]==42){ echo 'selected';} ?> >42</option>  
    <option value="43" <?php if($m_savetimes1[1]==43){ echo 'selected';} ?> >43</option> 
    <option value="44" <?php if($m_savetimes1[1]==44){ echo 'selected';} ?> >44</option>
    <option value="45" <?php if($m_savetimes1[1]==45){ echo 'selected';} ?> >45</option>  
    <option value="46" <?php if($m_savetimes1[1]==46){ echo 'selected';} ?> >46</option> 
    <option value="47" <?php if($m_savetimes1[1]==47){ echo 'selected';} ?> >47</option>
    <option value="48" <?php if($m_savetimes1[1]==48){ echo 'selected';} ?> >48</option> 
    <option value="49" <?php if($m_savetimes1[1]==49){ echo 'selected';} ?> >49</option>
    <option value="50" <?php if($m_savetimes1[1]==50){ echo 'selected';} ?> >50</option> 
    <option value="51" <?php if($m_savetimes1[1]==51){ echo 'selected';} ?> >51</option>  
    <option value="52" <?php if($m_savetimes1[1]==52){ echo 'selected';} ?> >52</option>  
    <option value="53" <?php if($m_savetimes1[1]==53){ echo 'selected';} ?> >53</option> 
    <option value="54" <?php if($m_savetimes1[1]==54){ echo 'selected';} ?> >54</option> 
    <option value="55" <?php if($m_savetimes1[1]==55){ echo 'selected';} ?> >55</option> 
    <option value="56" <?php if($m_savetimes1[1]==56){ echo 'selected';} ?> >56</option> 
     <option value="57" <?php if($m_savetimes1[1]==57){ echo 'selected';} ?> >57</option> 
      <option value="58" <?php if($m_savetimes1[1]==58){ echo 'selected';} ?> >58</option>
        <option value="59" <?php if($m_savetimes1[1]==59){ echo 'selected';} ?> >59</option>
</select>
分 </td>
  </tr>
  <tr>
    <td width="80" height="30">退码分钟：</td>
    <td width="840" height="30"><input name="DelMinute" type="text" id="DelMinute" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="2-300" <?php if(empty($data1['m_retreat'])){ echo 'value="30"';}else{ echo 'value="'.$data1['m_retreat'].'"'; } ?>  size="6" maxlength="2"></td>
  </tr>
  <tr>
    <td width="80" height="30">备注：</td>
    <td width="840" height="30"><input name="Remark" type="text" id="Remark" size="60" maxlength="60" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" value="<?php echo ($data1['m_remark']); ?>" /></td>
  </tr>
  <tr>
    <td width="80" height="30">&nbsp;</td>
    <td width="840" height="30">&nbsp;</td>
  </tr>
  <tr>
    <td width="80" height="90">销售限制：</td>
    <td width="840" height="90"><table width="828" border="0" cellspacing="1" cellpadding="0" bgcolor="#666699">
      <tbody><tr>
        <td width="100" height="28" align="center" bgcolor="#FFFFFF">销售类型</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType1" type="checkbox" id="CheckType1" value="1" <?php if($data1['4ding_xiane']==1){echo 'checked';} ?>  >直码</label></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType2" type="checkbox" id="CheckType2" value="1" <?php if($data1['2xian_xiane']==1){echo 'checked';} ?> >两同</label></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType3" type="checkbox" id="CheckType3" value="1" <?php if($data1['3xian_xiane']==1){echo 'checked';} ?> >三同</label></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType4" type="checkbox" id="CheckType4" value="1" <?php if($data1['4xian_xiane']==1){echo 'checked';} ?> >四同</label></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType5" type="checkbox" id="CheckType5" value="1" <?php if($data1['2ding_xiane']==1){echo 'checked';} ?> >两定</label></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><label><input name="CheckType6" type="checkbox" id="CheckType6" value="1" <?php if($data1['3ding_xiane']==1){echo 'checked';} ?> >三定</label></td>
      </tr>
      <tr>
        <td width="100" height="28" align="center" bgcolor="#FFFFFF">每码限售</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit1" type="text" id="TLimit1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding41.'"'; } ?>  size="6" maxlength="5">
        </td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit2" type="text" id="TLimit2" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong21.'"'; } ?> size="6" maxlength="5">
        </td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit3" type="text" id="TLimit3" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong31.'"'; } ?> size="6" maxlength="5">
        </td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit4" type="text" id="TLimit4" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong41.'"'; } ?> size="6" maxlength="5">
        </td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit5" type="text" id="TLimit5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding21.'"'; } ?> size="6" maxlength="5">
        </td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="TLimit6" type="text" id="TLimit6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding31.'"'; } ?> size="6" maxlength="5">
        </td>
      </tr>
      <tr>
        <td width="100" height="28" align="center" bgcolor="#FFFFFF">单注限售</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit1" type="text" id="ALimit1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding42.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit2" type="text" id="ALimit2" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong22.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit3" type="text" id="ALimit3" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong32.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit4" type="text" id="ALimit4" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong42.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit5" type="text" id="ALimit5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding22.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimit6" type="text" id="ALimit6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding32.'"'; } ?> size="6" maxlength="5"></td>
      </tr>
      <tr>
        <td width="100" height="28" align="center" bgcolor="#FFFFFF">单注最低下注金额</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits1" type="text" id="ALimit1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding43.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits2" type="text" id="ALimit2" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong23.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits3" type="text" id="ALimit3" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong33.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits4" type="text" id="ALimit4" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->tong43.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits5" type="text" id="ALimit5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding23.'"'; } ?> size="6" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="ALimits6" type="text" id="ALimit6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data2)){ echo 'value="1"';}else{ echo 'value="'.$data2->ding33.'"'; } ?> size="6" maxlength="5"></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td width="80" height="30">&nbsp;</td>
    <td width="840" height="30">&nbsp;</td>
  </tr>
  <tr>
    <td width="80" height="30">赔率调整：</td>
    <td width="840" height="30"><label><input name="CheckAutoScale" type="checkbox" id="CheckAutoScale" value="1" <?php if($data1['m_odds']==1){echo 'checked';} ?> >自动降赔率</label></td>
  </tr>
  <tr>
    <td width="80" height="320">赔率设置：</td>
    <td width="840" height="320"><table width="778" border="0" cellspacing="1" cellpadding="0" bgcolor="#666699">
      <tbody><tr>
        <td width="50" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">说明</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">中奖概率</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">初始赔率</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">赔率下降阀值</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">销售增量</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">赔率下调步长</td>
      </tr>
      <tr>
        <td width="50" height="28" align="center" bgcolor="#FFFFFF">直码</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/10000</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale1" type="text" id="BScale1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="9800"';}else{ echo 'value="'.$data3->ding41.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue1" type="text" id="BValue1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->ding42.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc1" type="text" id="BInc1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="5"';}else{ echo 'value="'.$data3->ding43.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep1" type="text" id="BStep1" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="1000"';}else{ echo 'value="'.$data3->ding44.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="50" rowspan="2" align="center" bgcolor="#FFFFFF">两同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">数字不同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/10.27</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale21" type="text" id="BScale21" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位" <?php if(empty($data3)){ echo 'value="9"';}else{ echo 'value="'.$data3->tong211.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue21" type="text" id="BValue21" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong212.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc21" type="text" id="BInc21" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->tong213.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep21" type="text" id="BStep21" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位"   <?php if(empty($data3)){ echo 'value="1.02"';}else{ echo 'value="'.$data3->tong214.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">两数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/19.12</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale22" type="text" id="BScale22" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位"  <?php if(empty($data3)){ echo 'value="16"';}else{ echo 'value="'.$data3->tong221.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue22" type="text" id="BValue22" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong222.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc22" type="text" id="BInc22" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->tong223.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep22" type="text" id="BStep22" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位"  <?php if(empty($data3)){ echo 'value="1.91"';}else{ echo 'value="'.$data3->tong224.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="50" rowspan="3" align="center" bgcolor="#FFFFFF">三同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">数字不同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/49.02</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale31" type="text" id="BScale31" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位"  <?php if(empty($data3)){ echo 'value="45"';}else{ echo 'value="'.$data3->tong311.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue31" type="text" id="BValue31" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong312.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc31" type="text" id="BInc31" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数"  <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->tong313.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep31" type="text" id="BStep31" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位"  <?php if(empty($data3)){ echo 'value="4.9"';}else{ echo 'value="'.$data3->tong314.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">两数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/94.34</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale32" type="text" id="BScale32" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位" <?php if(empty($data3)){ echo 'value="68"';}else{ echo 'value="'.$data3->tong321.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue32" type="text" id="BValue32" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong322.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc32" type="text" id="BInc32" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->tong323.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep32" type="text" id="BStep32" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后两位" <?php if(empty($data3)){ echo 'value="9.43"';}else{ echo 'value="'.$data3->tong324.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">三数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/270.27</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale33" type="text" id="BScale33" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="188"';}else{ echo 'value="'.$data3->tong331.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue33" type="text" id="BValue33" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong332.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc33" type="text" id="BInc33" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo 'value="'.$data3->tong333.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep33" type="text" id="BStep33" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="27"';}else{ echo 'value="'.$data3->tong334.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="50" rowspan="5" align="center" bgcolor="#FFFFFF">四同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">数字不同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/416.67</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale41" type="text" id="BScale41" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="360"';}else{ echo 'value="'.$data3->tong411.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue41" type="text" id="BValue41" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong412.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc41" type="text" id="BInc41" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo '
        value="'.$data3->tong413.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep41" type="text" id="BStep41" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="41.6"';}else{ echo 'value="'.$data3->tong414.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">两数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/833.33</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale42" type="text" id="BScale42" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="666"';}else{ echo 'value="'.$data3->tong421.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue42" type="text" id="BValue42" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong422.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc42" type="text" id="BInc42" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo '
        value="'.$data3->tong423.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep42" type="text" id="BStep42" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="83.3"';}else{ echo 'value="'.$data3->tong424.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">两两相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/1666.67</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale43" type="text" id="BScale43" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="1200"';}else{ echo 'value="'.$data3->tong431.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue43" type="text" id="BValue43" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong432.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc43" type="text" id="BInc43" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo '
        value="'.$data3->tong433.'"'; } ?>size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep43" type="text" id="BStep43" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位"  <?php if(empty($data3)){ echo 'value="166"';}else{ echo 'value="'.$data3->tong434.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">三数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/2500</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BScale44" type="text" id="BScale44" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="1888"';}else{ echo 'value="'.$data3->tong441.'"'; } ?>  size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BValue44" type="text" id="BValue44" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong442.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BInc44" type="text" id="BInc44" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo '
        value="'.$data3->tong443.'"'; } ?> size="8" maxlength="5"></td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF"><input name="BStep44" type="text" id="BStep44" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="250"';}else{ echo 'value="'.$data3->tong444.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">四数相同</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/10000</td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BScale45" type="text" id="BScale45" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="3000"';}else{ echo 'value="'.$data3->tong451.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BValue45" type="text" id="BValue45" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->tong452.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BInc45" type="text" id="BInc45" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="10"';}else{ echo '
        value="'.$data3->tong453.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BStep45" type="text" id="BStep45" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="1000"';}else{ echo 'value="'.$data3->tong454.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td height="28" align="center" bgcolor="#FFFFFF">两定</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/100</td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BScale5" type="text" id="BScale5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="98"';}else{ echo 'value="'.$data3->ding21.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BValue5" type="text" id="BValue5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="5"';}else{ echo 'value="'.$data3->ding22.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BInc5" type="text" id="BInc5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="5"';}else{ echo 'value="'.$data3->ding23.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BStep5" type="text" id="BStep5" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到小数点后一位" <?php if(empty($data3)){ echo 'value="5"';}else{ echo 'value="'.$data3->ding24.'"'; } ?> size="8" maxlength="5"></td>
      </tr>
      <tr>
        <td height="28" align="center" bgcolor="#FFFFFF">三定</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="120" height="28" align="center" bgcolor="#FFFFFF">1/1000</td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BScale6" type="text" id="BScale6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="980"';}else{ echo 'value="'.$data3->ding31.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BValue6" type="text" id="BValue6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="50"';}else{ echo 'value="'.$data3->ding32.'"'; } ?> size="8" maxlength="5"></td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BInc6" type="text" id="BInc6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="整数" <?php if(empty($data3)){ echo 'value="20"';}else{ echo 'value="'.$data3->ding33.'"'; } ?> size="8" maxlength="5"> </td>
        <td height="28" align="center" bgcolor="#FFFFFF"><input name="BStep6" type="text" id="BStep6" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" title="可精确到个位" <?php if(empty($data3)){ echo 'value="50"';}else{ echo 'value="'.$data3->ding34.'"'; } ?> size="8" maxlength="5"></td>


      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td width="80" height="30">&nbsp;</td>
    <td width="840" height="30">&nbsp;</td>
  </tr>
  <tr>
    <td width="80" height="30">&nbsp;</td>
    <td width="840" height="30"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="300" height="30" align="center"><a href="JavaScript:add();" class="BtnStyle" onfocus="this.blur()" title="创建期号稍慢，请勿重复点击！">确定</a></td>
        <td width="300" height="30" align="center"><a href="Period.asp" class="BtnStyle" onfocus="this.blur()">取消</a></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td width="80" height="30">&nbsp;</td>
    <td width="840" height="30">&nbsp;</td>
  </tr>

</tbody></table>

</form>
<script>
    ///Index/saveTask
    function add(){
       var Period,StartYear,StartMonth,StartDay,StartHour,StartMinute,CloseYear,CloseMonth,CloseDay,CloseHour,CloseMinute,AwardYear,AwardMonth,AwardDay,AwardHour,AwardMinute,DelMinute,Remark,CheckType1,TLimit1,ALimit1,ALimits1,CheckType2,TLimit2,ALimit2,ALimits2,CheckType3,TLimit3,ALimit3,ALimits3,CheckType4,TLimit4,ALimit4,ALimits4,CheckType5,TLimit5,ALimit5,ALimits5,CheckType6,TLimit6,ALimit6,ALimits6,BScale1,BValue1,BInc1,BStep1,BScale21,BValue21,BInc21,BStep21,BScale22,BValue22,BInc22,BStep22,BScale31,BValue31,BInc31,BStep31,BScale32,BValue32,BInc32,BStep32,BScale33,BValue33,BInc33,BStep33,BScale41,BValue41,BInc41,BStep41,BScale42,BValue42,BInc42,BStep42,BScale43,BValue43,BInc43,BStep43,BScale44,BValue44,BInc44,BStep44,BScale45,BValue45,BInc45,BStep45,BScale5,BValue5,BInc5,BStep5,BScale6,BValue6,BInc6,BStep6,CheckAutoScale;

           
            StartYear=$('select[name="StartYear"] option:selected').val();
            StartMonth=$('select[name="StartMonth"] option:selected').val();
            StartDay=$('select[name="StartDay"] option:selected').val();
            StartHour=$('select[name="StartHour"] option:selected').val();
            StartMinute=$('select[name="StartMinute"] option:selected').val();
            CloseYear=$('select[name="CloseYear"] option:selected').val();
            CloseMonth=$('select[name="CloseMonth"] option:selected').val();
            CloseDay=$('select[name="CloseDay"] option:selected').val();
            CloseHour=$('select[name="CloseHour"] option:selected').val();
            CloseMinute=$('select[name="CloseMinute"] option:selected').val();
            AwardYear=$('select[name="AwardYear"] option:selected').val();
            AwardMonth=$('select[name="AwardMonth"] option:selected').val();
            AwardDay=$('select[name="AwardDay"] option:selected').val();
            AwardHour=$('select[name="AwardHour"] option:selected').val();
            AwardMinute=$('select[name="AwardMinute"] option:selected').val();
            DelMinute=$('input[name="DelMinute"]').val();
            Remark=$('input[name="Remark"]').val();
            CheckAutoScale=checks('CheckAutoScale');

            //CheckType1=$('input[name="CheckType1"] :checked').val();
             CheckType1=checks('CheckType1');
            TLimit1=$('input[name="TLimit1"]').val();
            ALimit1=$('input[name="ALimit1"]').val();
            ALimits1=$('input[name="ALimits1"]').val();
           // CheckType2=$('input[name="CheckType2"] :checked').val();
             CheckType2=checks('CheckType2');
            TLimit2=$('input[name="TLimit2"]').val();
            ALimit2=$('input[name="ALimit2"]').val();
            ALimits2=$('input[name="ALimits2"]').val();
            //CheckType3=$('input[name="CheckType3"] :checked').val();
             CheckType3=checks('CheckType3');
            TLimit3=$('input[name="TLimit3"]').val();
            ALimit3=$('input[name="ALimit3"]').val();
            ALimits3=$('input[name="ALimits3"]').val();
            //CheckType4=$('input[name="CheckType4"] :checked').val();
             CheckType4=checks('CheckType4');
            TLimit4=$('input[name="TLimit4"]').val();
            ALimit4=$('input[name="ALimit4"]').val();
            ALimits4=$('input[name="ALimits4"]').val();
           // CheckType5=$('input[name="CheckType5"] :checked').val();
            CheckType5=checks('CheckType5');
            TLimit5=$('input[name="TLimit5"]').val();
            ALimit5=$('input[name="ALimit5"]').val();
            ALimits5=$('input[name="ALimits5"]').val();
           // CheckType6=$('input[name="CheckType6"] :checked').val();
            CheckType6=checks('CheckType6');
            TLimit6=$('input[name="TLimit6"]').val();
            ALimit6=$('input[name="ALimit6"]').val();
            ALimits6=$('input[name="ALimits6"]').val();
            //alert(CheckType6);
            BScale1=$('input[name="BScale1"]').val();
            BValue1=$('input[name="BValue1"]').val();
            BInc1=$('input[name="BInc1"]').val();
            BStep1=$('input[name="BStep1"]').val();
            BScale21=$('input[name="BScale21"]').val();
            BValue21=$('input[name="BValue21"]').val();
            BInc21=$('input[name="BInc21"]').val();
            BStep21=$('input[name="BStep21"]').val();
            BScale22=$('input[name="BScale22"]').val();
            BValue22=$('input[name="BValue22"]').val();
            BInc22=$('input[name="BInc22"]').val();
            BStep22=$('input[name="BStep22"]').val();
            BScale31=$('input[name="BScale31"]').val();
            BValue31=$('input[name="BValue31"]').val();
            BInc31=$('input[name="BInc31"]').val();
            BStep31=$('input[name="BStep31"]').val();
            BScale32=$('input[name="BScale32"]').val();
            BValue32=$('input[name="BValue32"]').val();
            BInc32=$('input[name="BInc32"]').val();
            BStep32=$('input[name="BStep32"]').val();
            BScale33=$('input[name="BScale33"]').val();
            BValue33=$('input[name="BValue33"]').val();
            BInc33=$('input[name="BInc33"]').val();
            BStep33=$('input[name="BStep33"]').val();

            BScale41=$('input[name="BScale41"]').val();
            BValue41=$('input[name="BValue41"]').val();
            BInc41=$('input[name="BInc41"]').val();
            BStep41=$('input[name="BStep41"]').val();

            BScale42=$('input[name="BScale42"]').val();
            BValue42=$('input[name="BValue42"]').val();
            BInc42=$('input[name="BInc42"]').val();
            BStep42=$('input[name="BStep42"]').val();

            BScale43=$('input[name="BScale43"]').val();
            BValue43=$('input[name="BValue43"]').val();
            BInc43=$('input[name="BInc43"]').val();
            BStep43=$('input[name="BStep43"]').val();
            
            BScale44=$('input[name="BScale44"]').val();
            BValue44=$('input[name="BValue44"]').val();
            BInc44=$('input[name="BInc44"]').val();
            BStep44=$('input[name="BStep44"]').val();
            BScale45=$('input[name="BScale45"]').val();
            BValue45=$('input[name="BValue45"]').val();
            BInc45=$('input[name="BInc45"]').val();
            BStep45=$('input[name="BStep45"]').val();
            BScale5=$('input[name="BScale5"]').val();
            BValue5=$('input[name="BValue5"]').val();
            BInc5=$('input[name="BInc5"]').val();
            BStep5=$('input[name="BStep5"]').val();
            BScale6=$('input[name="BScale6"]').val();
            BValue6=$('input[name="BValue6"]').val();
            BInc6=$('input[name="BInc6"]').val();
            BStep6=$('input[name="BStep6"]').val();
           var PeriodID=$('input[name="PeriodID"]').val();
           var Year=$('input[name="Year"]').val();
            Period=$('input[name="Period"]').val();

            var urls='/Index/saveTask';
            //alert(id)
            $.ajax({
                type: 'POST',
                url: urls,
                data:{
                'CheckAutoScale':CheckAutoScale,
                'PeriodID':PeriodID,
                'Period':Period,
                'Year':Year,
                'StartYear':StartYear,
                'StartMonth':StartMonth,
                'StartDay':StartDay,
                'StartHour':StartHour,
                'StartMinute':StartMinute,
                'CloseYear':CloseYear,
                'CloseMonth':CloseMonth,
                'CloseDay':CloseDay,
                'CloseHour':CloseHour,
                'CloseMinute':CloseMinute,
                'AwardYear':AwardYear,
                'AwardMonth':AwardMonth,
                'AwardDay':AwardDay,
                'AwardHour':AwardHour,
                'AwardMinute':AwardMinute,
                'DelMinute':DelMinute,
                'Remark':Remark,
                'CheckType1':CheckType1,
                'TLimit1':TLimit1,
                'ALimit1':ALimit1,
                'ALimits1':ALimits1,
                'CheckType2':CheckType2,
                'TLimit2':TLimit2,
                'ALimit2':ALimit2,
                'ALimits2':ALimits2,
                'CheckType3':CheckType3,
                'TLimit3':TLimit3,
                'ALimit3':ALimit3,
                'ALimits3':ALimits3,
                'CheckType4':CheckType4,
                'TLimit4':TLimit4,
                'ALimit4':ALimit4,
                'ALimits4':ALimits4,
                'CheckType5':CheckType5,
                'TLimit5':TLimit5,
                'ALimit5':ALimit5,
                'ALimits5':ALimits5,
                'CheckType6':CheckType6,
                'TLimit6':TLimit6,
                'ALimit6':ALimit6,
                'ALimits6':ALimits6,
                'BScale1':BScale1,
                'BValue1':BValue1,
                'BInc1':BInc1,
                'BStep1':BStep1,
                'BScale1':BScale1,
                'BValue1':BValue1,
                'BInc21':BInc21,
                'BStep21':BStep21,
                'BScale21':BScale21,
                'BValue21':BValue21,
                'BInc22':BInc22,
                'BStep22':BStep22,
                'BScale22':BScale22,
                'BValue22':BValue22,
                'BInc31':BInc31,
                'BStep31':BStep31,
                'BScale31':BScale31,
                'BValue31':BValue31,
                'BInc32':BInc32,
                'BStep32':BStep32,
                'BScale32':BScale32,
                'BValue32':BValue32,
                'BInc33':BInc33,
                'BStep33':BStep33,
                'BScale33':BScale33,
                'BValue33':BValue33,
                'BInc41':BInc41,
                'BStep41':BStep41,
                'BScale41':BScale41,
                'BValue41':BValue41,
                'BInc42':BInc42,
                'BStep42':BStep42,
                'BScale42':BScale42,
                'BValue42':BValue42,
                'BInc43':BInc43,
                'BStep43':BStep43,
                'BScale43':BScale43,
                'BValue43':BValue43,
                'BInc44':BInc44,
                'BStep44':BStep44,
                'BScale44':BScale44,
                'BValue44':BValue44,
                'BInc45':BInc45,
                'BStep45':BStep45,
                'BScale45':BScale45,
                'BValue45':BValue45,
                'BInc5':BInc5,
                'BStep5':BStep5,
                'BScale5':BScale5,
                'BValue5':BValue5,
                'BInc6':BInc6,
                'BStep6':BStep6,
                'BScale6':BScale6,
                'BValue6':BValue6,
               
                },
                dataType: 'json',
                success: function(data){
                    if(data.code==true){
                      $(".notic").html(data.titles);
                      $(".notic").fadeIn().delay(1000).fadeOut(); 
                    }else{
                      $(".notic").html(data.titles);
                      $(".notic").fadeIn().delay(1000).fadeOut();     
                    }
                    //location.replace(location.href);
                    //setTimeout('location.replace(location.href)',3000);
                    setTimeout('parent.window.location.href="'+data.urls+'";',3000);
                },
                error:function(data) {
                    console.log(data.msg);
                },
            }); 
    }

      function checks(a){ 
             var chk_value ='0'; 
             $('input[name="'+a+'"]:checked').each(function(){ 
              chk_value=$(this).val(); 
              }); 
              return chk_value;
            }
</script>
<div class="notic"></div>
<style>
.notic {
    position: fixed;
    top: 40%;
    left: 30%;
    width: 40%;
    box-sizing: border-box;
    margin: 0 auto;
    text-align: center;
    background-color: #000;
    color: #fff;
    padding: 30px;
    opacity: 0.6;
    border-radius: 10px;
    display: none;
    z-index: 29891015;
}
</style>
</body></html>