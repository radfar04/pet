<html>
   <head>
      <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      <script>
         function getMessage() {
            console.log('Here');
            $.ajax({
               type:'POST',
               url:'./getmsg',
               //data:'_token = <php echo csrf_token() ?>',
               data: { somefield: "Some field value", _token: '{{csrf_token()}}' },
               success:function(data) {
                   console.log(data.msg);
                   console.log('Here');
                  $("#msg").html(data.msg);
               }
            });
         }
      </script>
   </head>
   
   <body>
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>
      <?php
         echo Form::button('Replace Message',['onClick'=>'getMessage()']);
      ?>
   </body>

</html>