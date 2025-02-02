<?php
    $page_content = "Attendence";
    $page_title ="Attendence Management";
    include('../master/header.php');
    require_once('../../backend/auth.php');
    include('../master/navbar.php');
    include('../../backend/connection.php');
?>
<div>
    <div class="mx-auto max-w-screen-2xl py-4 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
            <div class="">
                <div class="flex justify-between mb-4">
                    <!-- <h1 class="text-2xl  mb-5">Actions</h1> -->
                    <div class="flex justify-center items-center space-x-2">
                        <div class=" flex space-x-2">
                            <select name="range" id="range" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-800 focus:border-gray-800 block w-50  p-2  ">
                                <option value="" selected disabled hidden class="text-gray-100">--Select Date Range--</option>
                                <option value="today"> Today</option>
                                <option value="week"> This week</option>
                                <option value="month"> This month</option>
                                <option value="year"> This year</option>
                                <option value="lastweek"> Last week</option>
                                <option value="lastmonth"> Last month</option>
                                <option value="lastyear"> Last year</option>
                                <option value="custom"> Custom</option>
                            </select>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="date" id="from-date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " format="dd-mm-yyyy">
                            </div>
                        </div>
                        <div>
                            <span class="">To</span>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="date" id="to-date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " placeholder="Search for items">
                            </div>
                        </div>
                        <div class=" flex space-x-2">
                            <div class="relative">
                                <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50  p-2  " placeholder="Search for staff name">
                            </div>
                            <div class=" flex space-x-2">
                                <select name="department" id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-800 focus:border-gray-800 block w-50  p-2  ">
                                    <option value="" selected disabled hidden class="text-gray-100">-- Select Department --</option>
                                    <option value="all" class="text-gray-800">-- All--</option>
                                </select>
                            </div>
                            <div class=" flex items-center justify-end  space-x-2">
                                <button id="btn-filter" class="bg-blue-600 hover:bg-blue-700 rounded-lg px-3   py-1 text-gray-50 hover:shadow-xl transition duration-150   text-lg ">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <button id="btn-refresh" class="hidden bg-gray-800 hover:bg-gray-700 rounded-lg px-3   py-1 text-gray-50 hover:shadow-xl transition duration-150   text-lg ">
                                    <i class="fa-solid fa-rotate-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end rounded-md shadow-sm space-x-3">
                        <button onclick="ExportToExcel('xlsx')" class=" bg-gray-800 hover:bg-gray-700 rounded-lg flex space-x-2 px-3 py-2 text-gray-50 hover:shadow-xl transition duration-150 flex items-center justify-center   text-sm ">
                            <i class="fa-solid fa-file-csv"></i>
                            <span>Export Excel</span>
                        </button>
                    </div>
                    <!-- <hr class="mt-5 border border-slate-100"> -->
                </div>
                <div class="overflow-x-auto shadow-sm h-[calc(100vh-250px)] ">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed " id="tbl_exporttable_to_xls">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="font-medium  py-3 px-6 tracking-wider text-left text-gray-700 uppercase ">
                                            Staff
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Date
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Department
                                        </th>
                                        <!-- <th scope="col" class="font-medium   py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Depart code
                                        </th> -->
                                        <!-- <th scope="col" class="font-medium  py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Device
                                        </th> -->
                                        <th scope="col" class="font-medium   py-3 px-6  tracking-wider text-left text-gray-700 uppercase ">
                                            Location
                                        </th>
                                        <th scope="col" class="font-medium   py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-In
                                        </th>
                                        <th scope="col" class="font-medium  py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Clock-Out
                                        </th>
                                        <th scope="col" class="font-medium   py-3 px-6  tracking-wider  text-center text-gray-700 uppercase ">
                                            Work Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y-2 divide-gray-200 " id="datatable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="inline-flex -space-x-px " id="pagination">
                    </ul>
                </div>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $.fn.startloading = function() {
        swal({
            title: "",
            text: "Processing......",
            buttons: false,
            closeOnClickOutside: false,
            timer: 0,
        });
    }
    $.fn.stoploading = function() {
        swal({
            title: "",
            text: "Processing......",
            buttons: false,
            closeOnClickOutside: false,
            timer: 200,
        });
    }
    var emptyRow = `
        <tr class="hover:bg-gray-100  border-y-2">
            <td colspan="8" class="py-2 px-6 text-sm text-center  text-gray-900 whitespace-nowrap ">
                No record found 👻
            </td>
        </tr>
    `;
    $.fn.RowTable = function(data) {
        var Row = `
           <tr class="hover:bg-gray-100 border-y-2">
            <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
             ${data['name']}
            </td>
            <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
              ${data['date']!=null?data['date']:""}
            </td>
             <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
              ${data['depart_name']!=null?data['depart_name']:""}
            </td>
    
           <td class="py-2 px-6 text-sm  text-gray-900 whitespace-nowrap ">
              ${data['location']!=null?data['location']:""}
            </td>
            <td class="py-2 px-6 text-sm  text-center  text-gray-900 whitespace-nowrap ">
                ${data['date_clock_in']!=null?data['date_clock_in']:""}
            </td>
            <td class="py-2 px-6 text-sm   text-center  text-gray-900 whitespace-nowrap ">
                ${data['date_clock_out']!=null?data['date_clock_out']:"-- : --"}
            </td>
            <td class="py-2 px-6 text-sm text-center  text-gray-900 whitespace-nowrap ">
                <span class="text-green-600 ${data['date_clock_out']!=null?' ':'wk-time'}" >${data['work_time']!=null? data['work_time'] :""} </span >
            </td>
        </tr>
        `
        return Row;
    };
    $.fn.GetDepart = function() {
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/departmentHandler.php',
            data: {
                mode: 'list',
            },
            dataType: "json",
            success: function(response) {
                if (response) {
                    $.each(response, function(indexes, data) {
                        $("#department").append(
                            `
                            <option value="${data.id}">${data.name}</option>
                            `
                        );
                    });
                }
            }
        });
    }
    $.fn.GetDepart();
    $('#department').val("all");
    $.fn.Pagination = function(data) {
        let link = "";
        if (data != null) {
            for (var i = 1; i <= data.page; i++) {
                if (i == data.page_number) {
                    link += `<li>
                        <button type="button"   onclick="$.fn.linkPage(${Number(i)})" data-page="${Number(i)}" class="link-btnn-page bg-blue-100 border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 ">${i}</button>
                </li>`;
                } else {
                    link += `
                 <li>
                        <button type="button" onclick="$.fn.linkPage(${Number(i)})" data-page="${Number(i)}" class="link-btnn-page bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 ">${i}</button>
                </li>`;
                }

            }
        }

        const prewpage = `
     <li>
            <button type="button" ${data.page_number ==1?'disabled':''}  onclick="$.fn.linkPage(${Number(data.page_number)-1})" data-page="${Number(data.page_number)-1}"  class="link-btnn-page  ${data.page_number==1?'bg-gray-200 text-gray-400':'bg-white hover:bg-gray-100 hover:text-gray-700'}   border border-gray-300 text-gray-500  rounded-l-lg leading-tight py-2 px-3 ">Previous</button>
    </li>`;

        const nextpage = `
    <li >
        <button ${data.page_number ==data.page?'disabled':''} onclick="$.fn.linkPage(${Number(data.page_number)+1})" type="button" data-page="${Number(data.page_number)+1}" class="link-btnn-page ${data.page_number==data.page?'bg-gray-200 text-gray-400':'bg-white hover:bg-gray-100 hover:text-gray-700'}   border border-gray-300 text-gray-500  rounded-r-lg leading-tight py-2 px-3 ">Next</button >
    </li>
     `;
        const page = prewpage + link + nextpage;
        return page;
    }
    let pagenum = 1;
    let per_page = 18;
    $.fn.setTimerLoading = setInterval(function(e) {
        let wk = $('.wk-time');
        $.each(wk, function(indexes, data) {
            let datatime = $(data).text()
            if (datatime != null && datatime != undefined) {
                let time = datatime.split(":");
                let h = parseInt(time[0]);
                let m = parseInt(time[1]);
                let s = parseInt(time[2]);
                s++;
                if (s == 60) {
                    m++;
                    s = 00;
                }
                if (m == 60) {
                    h++;
                    m = 00;
                }
                h = ("0" + h).slice(-2);
                m = ("0" + m).slice(-2);
                s = ("0" + s).slice(-2);
                let returnDate = h + ':' + m + ':' + s;
                $(data).text(returnDate);
            }
        });
    }, 1000);
    $('#range').val('today');
    $('#from-date').val(moment(new Date()).format("YYYY-MM-DD"))
    $('#to-date').val(moment(new Date()).add(1, "day").format("YYYY-MM-DD"))
    $.fn.GetList = function(pagenum) {
        $.fn.startloading();
        var fromDate = $('#from-date').val();
        var toDate = $('#to-date').val();
        var search = $('#table-search').val();
        var department = $('#department').val()
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/attendanceHandler.php',
            data: {
                mode: 'list',
                per_page: per_page,
                page_number: pagenum,
                from: fromDate,
                to: toDate,
                department: department

            },
            dataType: "json",
            success: function(response) {
                $("#datatable").empty();
                $.fn.stoploading();
                if (response.data == "No record!") {
                    $('#pagination').empty();
                    $("#datatable").append(
                        emptyRow
                    );
                    return;
                }
                if (response.data) {
                    $.each(response.data, function(indexes, data) {
                        $("#datatable").append(
                            $.fn.RowTable(data)
                        );
                    });
                    $('#pagination').empty();
                    $('#pagination').append(
                        $.fn.Pagination(response.paginate)
                    )
                }
            }
        });
    }
    $.fn.linkPage = function(e) {
        pagenum = e;
        $.fn.GetList(e);
    }
    $.fn.GetList(pagenum);
    $('#btn-refresh').click(function() {
        $.fn.GetList(pagenum);
    })
    $('#range').change(function() {
        let range = $(this).val();
        switch (range) {
            case 'today':
                $('#from-date').val(moment(new Date()).format("YYYY-MM-DD"))
                $('#to-date').val(moment(new Date()).add(1, "day").format("YYYY-MM-DD"))
                break;
            case 'week':
                // $('#from-date').val(moment(new Date()).format("YYYY-MM-DD"))
                $('#from-date').val(moment().startOf("week").format("YYYY-MM-DD"))
                $('#to-date').val(moment(new Date($('#from-date').val())).add(6, "day").format("YYYY-MM-DD"))
                break;
            case 'month':
                $('#from-date').val(moment().startOf("month").format("YYYY-MM-DD"))
                $('#to-date').val(moment().endOf("month").format("YYYY-MM-DD"))
                break;
            case 'year':
                $('#from-date').val(moment().startOf("year").format("YYYY-MM-DD"))
                $('#to-date').val(moment().endOf("year").format("YYYY-MM-DD"))
                break;
            case 'lastweek':
                $('#from-date').val(moment().subtract(1, "week").startOf("week").format("YYYY-MM-DD"))
                $('#to-date').val(moment(new Date($('#from-date').val())).endOf("week").format("YYYY-MM-DD"))
                break;
            case 'lastmonth':
                $('#from-date').val(moment().subtract(1, "month").format("YYYY-MM-DD"))
                $('#to-date').val(moment().startOf("month").format("YYYY-MM-DD"))
                break;
            case 'lastyear':
                $('#from-date').val(moment().subtract(1, "year")
                    .startOf("year").format("YYYY-MM-DD"))
                $('#to-date').val(moment().subtract(1, "year")
                    .endOf("year").format("YYYY-MM-DD"))
                break;
            default:
        }
    })
    // Default when open 




    $('#from-date').change(function() {
        $('#range').val('custom');
    })
    $('#to-date').change(function() {
        $('#range').val('custom');
    })


    $("#btn-filter").click(function() {
        var fromDate = $('#from-date').val();
        var toDate = $('#to-date').val();
        var search = $('#table-search').val();
        var department = $('#department').val()

        $.fn.startloading();
        $.ajax({
            type: "GET",
            url: '/staffAttendence/backend/attendanceHandler.php',
            data: {
                mode: 'filter',
                search: search,
                per_page: per_page,
                page_number: pagenum,
                from: fromDate,
                to: toDate,
                department: department

            },
            dataType: "json",
            success: function(response) {
                $("#datatable").empty();
                $.fn.stoploading();
                console.log(response)
                if (response.data == "No record!") {
                    $('#pagination').empty();
                    $("#datatable").append(
                        emptyRow
                    );
                    return;
                }
                if (response.data) {
                    $.each(response.data, function(indexes, data) {
                        $("#datatable").append(
                            $.fn.RowTable(data)
                        );
                    });
                    $('#pagination').empty();
                    $('#pagination').append(
                        $.fn.Pagination(response.paginate)
                    )
                }
            }
        })
    });





});
</script>
<?php
    include('../master/footer.php');
?>