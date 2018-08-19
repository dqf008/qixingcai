$(".check_input").blur(function() {
  var num = $(this).val();
  var obj = $(this);
  check_form(obj,num);



});


function check_form(obj,num){
  var reg1 = /([a-zA-Z])/ig;
  var reg = /([`~!@#$%^&*()_+<>?:"{},\/;'[\]])/ig;
  var reg2 = /([·~！#@￥%……&*（）——+《》？：“{}，。\、；’‘【\】])/ig;
  obj.val(obj.val().replace(reg, ""));
  obj.val(obj.val().replace(reg1, ""));
  obj.val(obj.val().replace(reg2, ""));
  if(num != '' && num != 0){
    if(parseInt(num)<0 || !isPositiveNum(num)){
    alert("金额格式不正确!");
    obj.val(0);
    return false;
    }
  }
  
}

function isPositiveNum(s){//是否为正整数
var re = /^[0-9]*[1-9][0-9]*$/ ;
return re.test(s)
}