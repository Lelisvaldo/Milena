<!DOCTYPE html>
<html lang="pt-BR">
    <body id="page-top" class="index">
 <p id="demo" onclick="carregar()">Click me.</p>
 <br>
<select id="perfil" class="form-control" >
    <option selected>selecione</option>
        <option value="1">PERFIL 1</option>
        <option value="2">PERFIL 2</option>
        <option value="3">PERFIL 3</option>
    </select>
    <br>
    <div class="resultado">
    
    </div>
      <!-- jQuery -->
         <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

<script>
    function carregar(id) {
         $.get( "ajaxEX.php?cdperfil=" + id,
          function( data ) {
            $('.resultado').html(data);
        });
    }
    $( document ).ready(function() {
      $("#perfil").change(function() {
           $('.resultado').html('carregando');
            carregar($(this).val());
      });
    });
</script>
</body>

</html>

