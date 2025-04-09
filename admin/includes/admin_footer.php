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
    function confirmDeleteMessage(messageId) {
        if (confirm('Are you sure you want to delete this message?')) {
            alert('Article ' + messageId + ' deleted.');
            return true; // Proceed with the deletion

        } else {
            return false; // Cancel the deletion
        }
    }

    // Select / Deselect all checkboxes
    document.getElementById('selectAllCheckbox').onclick = function() {
        let checkboxes = document.querySelectorAll('.messageCheckbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };

    // Delete selected messages
    document.getElementById('deleteSelectedBtn').onclick = function() {
        let selectIDs = [];
        let checkboxes = document.querySelectorAll('.messageCheckbox:checked');

        checkboxes.forEach((checkbox) => {
            selectIDs.push(checkbox.value);
        });

        if (selectIDs.length === 0) {
            alert("Please select at least one message to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected messages?")) {
            sendDeleteRequest(selectIDs);
        }
    }

    // Function to send delete using ajax
    function sendDeleteRequest(messageIds) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('admin/delete-selected-messages.php'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Messages deleted successfully!");
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert("Error deleting articles: " + response.message);
                }
            }
        };
        xhr.send(JSON.stringify({
            message_ids: messageIds
        }));
    }
</script>
</body>

</html>