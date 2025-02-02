    <?php
      $page_content = "Department";
    $page_title ="Department: Update";
    require_once('../../backend/auth.php');
    require_once('../../backend/adminAuth.php');
    include('../master/header.php');
    include('../master/navbar.php');
    // include('../../backend/connection.php');
?>
    <div class="bg-gray-100 w-full  flex items-start justify-center h-[calc(100vh-100px)]">
        <div class="w-full py-8">
            <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-4 mx-auto px-16 py-8 rounded-lg shadow">

                <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Update departments</h2>
                <form class="my-8 text-sm" id="submitForm">
                    <!-- Mode Action -->
                    <input type="hidden" name="mode" value="update">
                    <input type="hidden" name="id" value="" id="departID">

                    <div class="flex flex-col my-4">
                        <label for="name" class="text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your name" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="code" class="text-gray-700">Code</label>
                        <input type="text" name="code_name" id="code_name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your code" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="code" class="text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" cols="50" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your description"></textarea>
                    </div>
                    <div class="flex  justify-between space-x-3">
                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button id="btn-backtolist" class="bg-gray-800 hover:bg-gray-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Back to list</button>
                        </div>
                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
    /*
    ការចាប់យក​ទិន្នន័យ ពី URL Params
    */
    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    /*
    ការចាប់យក​ទិន្នន័យ ពី URL Params
    */
    const id = $.urlParam('id');
    $.ajax({
        type: "GET",
        url: '/staffAttendence/backend/departmentHandler.php',
        data: {
            mode: 'edit',
            id: id
        },
        dataType: "json",
        success: function(response) {
            // if (response) {
            console.log(response)
            $('#departID').val(response.id);
            $('#name').val(response.name);
            $('#code_name').val(response.code_name);
            $('#description').val(response.description);
        }
    });
    $('#btn-backtolist').click(function() {
        document.location = "/staffAttendence/frontend/department"
    })

    $('#submitForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/staffAttendence/backend/departmentHandler.php',
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (typeof response == 'object' && response.error != null) {
                    swal("Errors ", response.error, "error");
                    return;
                }
                if (response) {
                    swal("Successfully ", "Operation was successfully processed ", "success");
                }
            }
        });
    });
});
    </script>
    <?php
    $page_content = "index";
    include('../master/footer.php');
?>