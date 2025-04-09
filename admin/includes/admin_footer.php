<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- </div> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all checkboxes
        const selectAllCheckbox = document.getElementById("selectAll");
        const checkboxes = document.querySelectorAll(".select-checkbox");
        const deleteSelectedButton = document.getElementById("deleteSelected");

        // Handle "Select All" functionality
        selectAllCheckbox.addEventListener("click", function() {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Handle single delete button
        document.querySelectorAll(".delete-single").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this message?")) {
                    deletePosts([id]);
                }
            });
        });

        // Handle "Delete Selected" button
        deleteSelectedButton.addEventListener("click", function() {
            const selectedIds = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);

            if (selectedIds.length === 0) {
                alert("Please select at least one message to delete.");
                return;
            }

            if (confirm("Are you sure you want to delete the selected messages?")) {
                deletePosts(selectedIds);
            }
        });

        // Function to send Ajax request to delete posts
        function deletePosts(ids) {
            console.log("Deleting posts with IDs:", ids); // Debugging: Log the IDs being sent
            fetch("delete_selected_messages.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        ids
                    }),
                })
                .then((response) => {
                    console.log("Server response status:", response.status); // Debugging: Log the response status
                    return response.json();
                })
                .then((data) => {
                    console.log("Server response data:", data); // Debugging: Log the response data
                    if (data.success) {
                        alert("Messages deleted successfully.");
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert("An error occurred while deleting messages: " + (data.error || "Unknown error."));
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred while deleting messages.");
                });
        }
    });
</script>
</body>

</html>