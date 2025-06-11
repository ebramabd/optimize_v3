$(function () {
    var myCursor = $('.mouse-move');
    if (myCursor.length) {
        if ($('body')) {
            const e = document.querySelector('.mouse-inner'),
                t = document.querySelector('.mouse-outer');
            let n, i = 0,
                o = !1;
            window.onmousemove = function (s) {
                o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
            }, $('body').on("mouseenter", "a, .cursor-pointer", function () {
                e.classList.add('mouse-hover'), t.classList.add('mouse-hover')
            }), $('body').on("mouseleave", "a, .cursor-pointer", function () {
                $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove('mouse-hover'), t.classList.remove('mouse-hover'))
            }), e.style.visibility = "visible", t.style.visibility = "visible"
        }
    }
});

function createDatatable(columns, ajax_url, order_option = [0, 'desc']) {
    $datatable = $('.ajax-data-table').DataTable({
        order: [order_option],
        processing: true,
        serverSide: true,
        searching: true,
        scrollX: true,
        columns: columns,
        ajax: ajax_url
    });

    $("#searchbox").keyup(function () {
        $datatable.search(this.value).draw();
    });

    return $datatable;
}

function drawVisualization() {

    const myChart       = document.getElementById('chart');
    const pending       = parseFloat(myChart.getAttribute('data-bookings_week'));
    const testing       = parseFloat(myChart.getAttribute('data-bookings_month'));
    const partsReceived = parseFloat(myChart.getAttribute('data-bookings_day'));

    var data = google.visualization.arrayToDataTable([
        ['Count', 'Pending', 'Parts Received', 'Testing'],
        ['Pending', pending, 0, 0],
        ['Parts Received', 0, partsReceived, 0],
        ['Testing', 0, 0, testing],
    ]);

    // Create and draw the visualization.
    new google.visualization.ColumnChart(document.getElementById('chart')).draw(data,
        {
            title: "Maintenance Status Count",
            width: 750,
            colors: ['#e0440e', '#E0AF00', '#6445D5', '#3686E0']
        }
    );
}

google.load("visualization", "1", {packages: ["corechart"]});
google.setOnLoadCallback(drawVisualization);
