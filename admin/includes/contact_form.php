<?php
// Get all messages from contact form
$messages = new Contact();
$message = $messages->getContactFormSubmissions();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_ids'])) {
    // Ensure selected_ids is always an array
    $selectedIds = (array) $_POST['selected_ids'];


    $messages->deleteSelectedMessages($selectedIds); // Pass the array of selected IDs


}

?>

<?php if ($messages): ?>
    <div class="table-responsive">
        <form method="POST" action="">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" />
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_ids[]" value="<?= htmlspecialchars($message->id) ?>" />
                            </td>
                            <td><?= htmlspecialchars($message->id) ?></td>
                            <td><?= htmlspecialchars($message->name) ?></td>
                            <td><?= htmlspecialchars($message->email) ?></td>
                            <td><?= htmlspecialchars($message->subject) ?></td>
                            <td><?= htmlspecialchars($message->message) ?></td>
                            <td><?= htmlspecialchars($message->created_at) ?></td> <!-- Assuming created_at is the date field -->
                            <td>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($message->id) ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger mt-2">Delete Selected</button>
        </form>
    </div>
<?php else: ?>
    <p>No messages found.</p>
<?php endif; ?>