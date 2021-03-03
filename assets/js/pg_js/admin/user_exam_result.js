var table='';

window.onload = function(){
	table=$('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : "controller.php?action=getUserExamStatus",
            	columns : [ {
            		"data" : "user_id"
            	},{
                        "data" : "user_name"
                  },{
                        "data" : "field_name"
                  },{
                        "data" : "semester"
                  },{
                        "data" : "exam_title"
                  },{
            		"data" : "correct_answer"
            	},{
            		"data" : "wrong_answer"
            	},{
                        "data" : "total_question"
                  },{
            		"data" : " "
            	} ],
            	columnDefs : [
            			{
            				"targets" : -1,
            				"data" : null,
            				"defaultContent" :'<div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button> <div class="dropdown-menu" aria-labelledby="about-us"> <a class="dropdown-item update1" id="show_user_answer" data-toggle="modal" data-target="#add_form" >show_user_answer</a></div>'
            			},
            			{
            				"targets" : [0],
            				"visible" : false,
            				"searchable" : false
            			}
            	],
            	"order" : [ [ 0, "desc" ] ],
            });

      $('#sample tbody').on('click','#show_user_answer',function(){
            // alert("hello");
            let data = table.row($(this).parents('tr')).data();
            // var data = table.row($(this).parents('tr')).data();
            // console.log(data);
            let exam_id = data['exam_id'];
            let user_id = data['user_id'];
            // console.log(data);
            // console.log(exam_id+" "+user_id);
            show_question(user_id,exam_id);
      });

}//close load function

var table1='';
function show_question(user_id,exam_id){
      $('#sample1').dataTable().fnDestroy();
      table1=$('#sample1').DataTable({
              dom: 'Bfrtip',
                  ajax : "controller.php?action=getReportQuestion&user_id="+user_id+"&exam_id="+exam_id,
                  columns : [ {
                        "data" : "question"
                  },{
                        "data" : "user_answer"
                  },{
                        "data" : "correct_answer"
                  }],
            });     
}

function res(){
      $('#add_form').modal('hide');
}