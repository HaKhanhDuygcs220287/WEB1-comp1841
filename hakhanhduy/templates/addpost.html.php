    <form action="" method="post">
        <!-- Post Text Input -->
        <label for="posttext">Type your questions here:</label>
        <textarea id="posttext" name="posttext" rows="3" cols="40" required></textarea>
        
        <!-- People Selection Dropdown -->
        <label for="peopleid">People:</label>
        <select id="peopleid" name="peopleid" required>
            <option value="">-- Select a Person --</option>
            <?php
            try {
                // Fetch people data from the database
                $peoples = $pdo->query('SELECT id, name FROM people')->fetchAll(PDO::FETCH_ASSOC);
                foreach ($peoples as $people) {
                    echo '<option value="' . htmlspecialchars($people['id'], ENT_QUOTES, 'UTF-8') . '">' 
                        . htmlspecialchars($people['name'], ENT_QUOTES, 'UTF-8') . '</option>';
                }
            } catch (PDOException $e) {
                echo '<option value="">Error fetching people</option>';
            }
            ?>
        </select>
        

        <label for="moduleid">Module:</label>
        <select id="moduleid" name="moduleid" required>
            <option value="">-- Select a Module --</option>
            <?php
            try {
                // Fetch module data from the database
                $modules = $pdo->query('SELECT id, modulename FROM module')->fetchAll(PDO::FETCH_ASSOC);
                foreach ($modules as $module) {
                    echo '<option value="' . htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') . '">'
                        . htmlspecialchars($module['modulename'], ENT_QUOTES, 'UTF-8') . '</option>';
                }
            } catch (PDOException $e) {
                echo '<option value="">Error fetching modules</option>';
            }
            ?>
        </select>

        <!-- Action Buttons -->
        <button type="submit" name="submit_add_list">Add Questions</button>
    </form>
