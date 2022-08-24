<div class="container">
    <div class="row">
        <div class="">
            <h3>Citizens Lists</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date of Birth</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Profession</th>
                    </tr>
                </thead>
                <?php

                $sql = "SELECT * FROM personal";

                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo"<tbody>";
                            echo "<tr>";
                            echo "<th scope='row' >" . $row['id'] . "</th>";
                            echo "<td>" . $row['firstname'] . " " . $row['midname'] . " " . $row['lastname'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['dob'] . "</td>";
                            echo "<td>" . "Sunkoshi-" . $row['ward'] . " " . $row['tole'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['prof'] . "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>