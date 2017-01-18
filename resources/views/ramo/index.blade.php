@extends('layout.user')

@section('content')
    <h1>Archivos</h1>

    <div>
        Buscar
        <input type="text" id="search-text">

        <br><br>

        Filtrar por:
        <input type="checkbox" name="type" value="1" class="type-check"> Trabajos &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="type" value="2" class="type-check"> Apuntes &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="type" value="3" class="type-check"> Presentación &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="type" value="4" class="type-check"> Pruebas &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="type" value="5" class="type-check"> Libro &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="type" value="6" class="type-check"> Encuesta

        <br><br>

        Ordenar por:
        <select id="order-by">
            <option value="created_at" selected>Fecha</option>
            <option value="client_name">Nombre</option>
        </select>
    </div>

    <table id="tFiles">
        <thead>
            <th id="client_name" data-sort="desc">Nombre</th>
            <th id="extension" data-sort="desc">Tipo</th>
            <th id="created_at" data-sort="desc" class="active-sort">Fecha</th>
        </thead>
        <tbody></tbody>
    </table>

    <button id="moreFiles">Cargar Más</button>
@endsection

@push('scripts')
<script>
    // Variables
    let html = '',
        page = 1,
        used = [],
        called = [],
        filter = [];

    // Setter de page
    function setPage(number = false) {
        if (number === false) {
            page++;
        } else {
            page = number;
        }
    }

    // Setted de used
    function setUsed() {
        used.length = 0;
    }

    // Setter de called
    function setCalled() {
        called.length = 0;
    }

    // Setter de filter
    function setFilter() {
        filter.length = 0;
    }

    // Limpiar datos y generar nueva búsqueda
    function clearAndSearch()
    {
        //Limpiar tabla
        $("#tFiles>tbody").empty();

        // Limpiar lo que se ha usado para deliminar acciones
        setUsed();
        setCalled();

        // Generar tabla
        getFiles(page);
    }

    function getFiles(page) {

        /*let sortBy = $("table thead .active-sort").attr('id'),
            sortOrder = $("table thead .active-sort").attr('data-sort');*/
        let sortBy = $( "#order-by option:selected" ).val(),
            sortOrder = 'desc',
            searchText = $("#search-text").val();

        setFilter();

        $('.type-check:input:checked').each(function() {
            filter.push($(this).val());
        });

        /*
         Se realiza for debido a ordenar
         Si no se hace, cada vez que se re-ordene la tabla, se tendría que cargar
         los archivos parcializados una vez más
         */
        for (var i=1; i<=page; i++) {

            // uri a consultar
            let uri = '/api/file?page=' + i + '&by=' + sortBy + '&order=' + sortOrder + '&text=' + searchText +'&filter=' + filter;

            // Validar que no se ha hecho la llama al uri con anterioridad
            // Se valida para evitar sobre carga en servidor
            if (called.indexOf(uri) == -1) {

                $.ajax({
                    url : uri,
                    dataType: 'json',
                }).done(function (response) {
                    // Generar html de tabla
                    $.each(response.data, function (key, value) {
                        if (used.indexOf(value.id) == -1 && used.includes(value.id) === false) {
                            html += '<tr>';
                            html += '<td>'+value.client_name+'</td>';
                            html += '<td>'+value.extension+'</td>';
                            html += '<td>'+value.created_at+'</td>';
                            html += '</tr>';

                            used.push(value.id);
                        }
                    });

                    // Agregar y limpiar html de tabla
                    $("#tFiles>tbody").append(html);
                    html = '';

                    // Guardar uris utilizadas
                    called.push(uri);

                    // Si se llega al límite, ocultamos el botón
                    if (response.last_page == page) {
                        $("#moreFiles").hide();
                    }

                }).fail(function () {
                    // Si existe algún error, sólo indicamos que no hay más archivos por mostrar
                    alert('No hay más archivos para cargar');
                });
            }
        }
    }

    // Cambiar orden
    $( "#order-by" ).change(function() {
        clearAndSearch();
    });

    // Filtrar por tipo
    $('.type-check').change(function() {
        clearAndSearch();
    });

    // Buscar texto
    $('#search-text').on('input',function ( e ) {
        clearAndSearch();
    });

    // Click en botón de pedir más
    $(document).on("click", "#moreFiles", function() {
        setPage();
        getFiles(page);
    });

    // Click en ordenar de a-z|z-a
    $(document).on("click", "th", function() {

        // Eliminar clases
        if ($(this).attr('id') == $("th").removeClass('active-sort').attr('id')) {
            $("#moreFiles").show();
        }

        // Ordenar por desc o asc
        if ($(this).attr('data-sort') == 'desc') {
            $(this).attr('data-sort', 'asc');
        } else {
            $(this).attr('data-sort', 'desc');
        }

        // Toggle en clases
        $("th").removeClass('active-sort');
        $(this).addClass('active-sort');

        $("#tFiles>tbody").empty();

        // Limpiar lo que se ha usado para deliminar acciones
        setUsed();
        setCalled();

        // Generar tabla
        getFiles(page);
    });

    // Ejecutar la llama la primera vez que carga la página
    getFiles(page);
</script>
@endpush