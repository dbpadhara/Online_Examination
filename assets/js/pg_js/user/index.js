
getExam();
function getExam(){

   $.ajax({
    url : 'controller.php',
    method : 'POST',
    data : {'action' : 'getExam', 'field_id':$('[name = field_id]').val()},
    success : function(res) {
        let data = JSON.parse(res);                                                                                         
        // console.log(data);
        
        $('#exam_id').html('');
        let optionf = $('<option/>');
        optionf.attr("value","").html("----------Select Exam----------");
        $('#exam_id').append(optionf);
        // alert(data);
        if(data==""){
            let optionTemp = $('<option/>');
            optionTemp.attr("value","0").html("User can't exam for you that time");
            $('#exam_id').append(optionTemp);    
        }
        let obj = data.data;


        $(obj).each(function(){
            let option = $('<option />');
            option.attr('value',this.exam_id).html(this.exam_title);
            $('#exam_id').append(option);
        });
    }
  });
}

function go_to_exam(){
    // window.location.href="./question.php";
    var exam = $('[name = "exam"]');

    if(empty_data(exam,"Select exam")){
        if(exam.val()==0){
            iziToast.error({
                title:'Select the exam',
                message:'your exam can not at time',
                position:'topRight'
            });
            return false;
        }else{ return true; }    
    }else{ return false; }
    

    $.ajax({
    url : 'controller.php',
    method : 'POST',
    data : {'action' : 'addExamStatus' ,'exam_id' : $('#exam_id').val(),'user_id':$('[name = "user_id"]').val()},
    success : function(res) {
        let data = JSON.parse(res);
        // console.log(data);
        if(data.status=="true"){
            window.location.href="./question.php"
        }else if(data.status=="exist"){
            iziToast.warning({
                title : "you have already attend the exam",
                message : 'you can not Attend Re-Exam',
                position : 'topRight'    
            });
        }else{
            iziToast.error({
                title : "you have already attend the exam",
                message : 'you can not Attend Re-Exam',
                position : 'topRight'    
            });
        }
    }
  });
}
