

$(document).ready(function () {



       $('#btn_search').click(function(){
       console.log($('#search_field').val());
        event.preventDefault();
        $('#search_result').html('');


      if($('#keyword').val().length >3){ 

         $('#message_keyword').html('');
         
     
       $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"search1", 
                    method:"POST", 
             
                   data:{keyword:$('#keyword').val(),_token:$('input[name="_token"]').val(),category_id:$('#category_id').val(), search_field:$('#search_field').val()},
          success:function(items){
            console.log(items);
             
            $('#search_result').html('');
             var temp_html='';
            
             if(items.length>0){
               console.log("LEngth"+items.length);
             for(var i=0;i<items.length;i++)
             {
               temp_html+="<div class='row-12 border rounded border-warning mb-1 border-1 d-flex'>";
                               temp_html+= "<div class='col-8 border' >";
                     
                                temp_html+= "<h5 ><a class='text-capitalize' href='/post/detail/"+items[i]['id']+"' target='_blank'>"+items[i]['title']+"</a></h5> <hr>";
                                
                                
                                temp_html+= "<div>";
                                temp_html+= "<p>"+items[i]['description']+"</p>";
                               temp_html+= "</div>";
                               temp_html+="</div>";
                     
                               temp_html+="<div class='col-4 border text-center' >";
                                             
                                          
                                        
                                           
                                            temp_html+= "<img class='product_avatar ' src='"+items[i]['avatar']+"' alt='picture of product'>";
                                          //  {{asset('uploads/images/'. $post['avatar'])}}
                                           temp_html+= "<br/>";
                                           temp_html+= "<h5 class='text-primary'>"+items[i]['price']+"&#36;</h5>";
                                           temp_html+="</div>";
                                           temp_html+="</div>";
     
     
             }

             $('#search_result').html(temp_html);
            }
            else {

              
              temp_html='<h3> No Post is found!</h3>';
               $('#search_result').html(temp_html);
               $('#search_result').css({'color':'blue'});


            }




          }
       });
   
   
   
      }
      else
      { $('#message_keyword').html("<p style='color:red;'> keyword should be more than 3 characters</p>");
      $('#search_result').html('');

   }


   })

  








})