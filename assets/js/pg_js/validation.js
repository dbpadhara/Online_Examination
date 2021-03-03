function logout(){
   $.ajax({
    url : 'controller.php',
    method : 'POST',
    data : {'action': 'logout'},
    success : function(res) {
        let data = JSON.parse(res);
        console.log(data);
        if(data){
          window.location.href="login.php";
        }else{

        }      
    }
  });
}

function empty_data(empty_val,name){
    var emptyval=empty_val.val();
    //alert(emptyval);
    //console.log(emptyval);
        if(emptyval==""){
            iziToast.error({
                title: ''+name+' is Required ',
                message: 'please enter '+name+'!!!',
                position: 'topRight'
              });
            empty_val.focus();
          return false;
        }
        else{
            return true;
        }
}

function check_image_file(file_name,file_type,kb){
    var Filename=file_name.val();
    var Extension = Filename.substring(Filename.lastIndexOf('.') + 1).toLowerCase();
    
    var size=$(file_name).prop('files')[0].size/1024;
    console.log(size+" "+Extension);
    var file_size = Math.floor(size);
    // alert("file_name "+Filename+" file size"+size+"  "+file_size+ "  ext"+Extension + " "+kb);
        if(file_type=="image"){
            if (Extension == "png" || Extension == "jpeg" || Extension == "jpg" ) {
            }
            else{
                iziToast.error({
                    title : 'file is not image file',
                    message : 'File extension can be valid for png, jpeg, jpg',
                    position : 'topRight'
                });
            return false;
            }//main else complete
        }
        if(file_type=="excel"){
            if (Extension == "xlsx") {
            }
            else{
                iziToast.error({
                    title : 'file is not excel file',
                    message : 'File extension can be valid for xlsx',
                    position : 'topRight'
                });
            return false;
            }   
        }
    if(parseInt(file_size)>= parseInt(kb)){
            // alert(file_size + " " +kb);
            
            iziToast.error({
                title : 'your file size is big',
                message : 'upload the file size less than '+kb+'',
                position : 'topRight'
            });
            return false;
        }else{
            return true;
        }
}

function same_length(val1,val2){
    var value1=val1.val();
    var value2=val2.val();
    //alert(emptyval);
    //console.log(emptyval);
        if(value1==value2){
            
          return true;
        }
        else{
            iziToast.error({
                title: 'enter the same password ',
                message: 'please same password of '+value1+' '+value2+'!!!',
                position: 'topRight'
              });
            val2.focus();
            return false;
        }
}

function password_length(password,length){
    let password_length=password.val();
    if(password_length.length<=length){
        iziToast.error({
            title: 'minimum length of password is '+length+'',
            message: 'please enter proper length of  password!!!',
            position: 'topRight'
          });
        password.focus();
      return false;
    }
    else{
        return true;
    }
}
    
//check String value
function allLetter(username,name){
    var regex=/^[a-zA-Z ]*$/;
    if(username.val().match(regex)){
        return true;
    }
    else{   iziToast.error({
            title: ' Enter proper '+name+'',
            message: 'contain only string [A-Z a-z] and space]!!!',
            position: 'topRight'
          });
        username.focus();
        return false;
    }
}
    
/*  var tablebody=$('#table_name tbody');
    var span=$('#ad_row');
    var tbpody=add_row_check(tbody,span);*/
    
function add_row_check(tablebody,span){
    if (tablebody.children().length == 0) {
        iziToast.error({
            title: 'Add row!',
            message: 'please click on add row button',
            position: 'topRight',
        });
        $(span).html('pl click and add row').addClass("text-danger");
        return false;
    }
}


//var gender=$('[name="gender"]:checked');

//console.log(gender);
//check radio
function radio(radio,span){
    if(radio.length == 0){
          iziToast.error({
            title: 'Pl select gender!',
            message: 'sdfsf',
            position: 'topRight'
          });
          $(span).html('select gender').addClass("text-danger");
          return false;
    }
}

//email
function email(emp_email){
    var email=emp_email.val();
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        //^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (reg.test(email) == false) 
    {
         iziToast.error({
            title: 'invalid email_id!',
            message: 'enter the particular email',
            position: 'topRight'
          });
         $(emp_email).focus();
      return false;
    }
    return true;
}

//pincode
function zipcode(pincode){
    var regex2=/^[1-9][0-9]{5}/;
    
    zipcod=pincode.val();
    
    if(regex2.test(zipcod)){
        return true;
    }else{
        iziToast.error({
            title: 'validate fail!',
            message: 'enter valid pincode value',
            position: 'topRight'
          });
        $(pincode).focus();
        return false;
    }
}


//mobile number
function check_mobile(mnumber1){
    var mnum=/^[0]?[6789]\d{9}$/;
    
    var mobile_number=mnumber1.val();
    
    if(mnum.test(mobile_number) == false){
        iziToast.error({
         title: 'invalid mobile number!',
         message: 'enter 10 digit number starting with 6/7/8/9',
         position: 'topRight'
        });
    $(mnumber1).focus();
    return false;
    }
    else{
        return true;
    }
}

function check_num_length(number,length){
    var check_number = number.val();
    // alert(check_number +" "+length);
    if(parseInt(check_number) < 0 ||parseInt(check_number)>parseInt(length)){
        iziToast.error({
            title : "enter the question for Range[0-100]",
            message : "enter the number less than 100 greater than 0",
            position : "topRight"
        });
        $(number).focus();
        return false;
    }else{
        return true;
    }
}

function date_less_current(date){
    var user_date = date.val();
    var cur_date = new Date(); 

    var set_date = new Date(user_date);
    
    var Cdate = cur_date.getDate();
    var Udate = set_date.getDate();
    var Cmonth = cur_date.getMonth();
    var Umonth = set_date.getMonth();
    var Cyear = cur_date.getFullYear();
    var Uyear = set_date.getFullYear(); 
    
    // alert(Cdate+" "+Udate+" "+Cmonth+" "+Umonth+" "+Cyear+" "+Uyear);
    if(Cdate == Udate & Cmonth == Umonth & Cyear == Uyear){
        // alert(cur_date + " " + set_date);
        return true;
    }else{
        if(cur_date > set_date){
            iziToast.error({
                title : "date select error",
                message : "selec the date after the current date or current data",
                position : "topRight",
            })
            $(user_date).focus();
            return false;
        }else{
            return true;
        }
    }
}



window.history.forward();
function noBack() {
    window.history.forward();
}