<?php
// Get all messages from contact form
$messages = new Contact();
$contactMessages = $messages->getContactFormSubmissions();
?>

<?php if ($contactMessages): ?>
    <div class="table-responsive">
        <button id="deleteSelected" class="btn btn-danger my-2 ">Delete Selected</button>
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
                <?php foreach ($contactMessages as $contactMessage): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="select-checkbox" value="<?= htmlspecialchars($contactMessage->id) ?>" />
                        </td>
                        <td><?= htmlspecialchars($contactMessage->id) ?></td>
                        <td><?= htmlspecialchars($contactMessage->name) ?></td>
                        <td><?= htmlspecialchars($contactMessage->email) ?></td>
                        <td><?= htmlspecialchars($contactMessage->subject) ?></td>
                        <td><?= htmlspecialchars($contactMessage->message) ?></td>
                        <td><?= htmlspecialchars($contactMessage->created_at) ?></td>
                        <td>
                            <button class="btn btn-danger delete-single" data-id="<?= htmlspecialchars($contactMessage->id) ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
<?php else: ?>
    <p>No messages found.</p>
<?php endif; ?>