<?php
    $visit = $conn->prepare("INSERT INTO visits (visit_time) VALUES (NOW())");
    $visit->execute();