<table id="public-files-table" class="table table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Creado</th>
        <th>Tamaño</th>
        <th>Tipo</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th id="public-foot-name">Nombre</th>
        <th id="public-foot-created">Creado</th>
        <th id="public-foot-size">Tamaño</th>
        <th id="public-foot-type">Tipo</th>
    </tr>
    </tfoot>
</table>

@push('scripts')
<script>

    genPublicTable();

    /**
     * Generar tabla con archivos públicos
     */
    function genPublicTable() {

        $('#public-files-table').DataTable({
            processing: true,
            serverSide: true,
            "bDestroy": true,
            "language": {
                "url": "{{ URL::to('/js/dataTables-es.json') }}"
            },
            ajax: {
                url: '{!! route('files.dataTable', ['idRamo' => 35, 'security' => 1]) !!}',
                method: 'POST'
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'size', name: 'size' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                });

                // Formatos
                $('th input').addClass('form-control');
                $("#public-foot-name input").css("max-width", "130px")
                $("#public-foot-created input").css("max-width", "130px");
                $("#public-foot-size input").css("max-width", "100px");
                $("#public-foot-type input").css("max-width", "130px");
                $("#public-foot-action input").hide();
            }
        });
    }
</script>
@endpush