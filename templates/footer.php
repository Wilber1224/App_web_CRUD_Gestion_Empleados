</main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

<script>
  $(document).ready( function(){
    $("#tabla_id").DataTable({
      "pageLength":3,
      lenghtMenu:[
        [5,10,25,50],
        [5,10,25,50],

      ],
      "language":{
        //  9dcbecd42ad se cambio por 1.13.1 de abajo OJO
        "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"

      }
    });
  });
  </script>


          <!-- SECCION DELETE ALERT -->
<script>
    function borrar(id)
{

        const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
    title: '¿Deseas borrar este registro?',
    text: "No se recuperará este registro",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, eliminalo!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
    }).then((result) => {
    if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        // swalWithBootstrapButtons.fire(
        // '¡Borrado!',
        // 'Se borró el registro :(',
        // 'Aceptar'
        // )
    } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire(
        'Cancelado',
        'No se borro nada :)',
        'error'
        )
    }
    })

    
};
</script>

</body>

</html>