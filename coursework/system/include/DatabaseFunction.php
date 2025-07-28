<?php
    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function allQuestions($pdo) {
        $questions = query($pdo, 'SELECT question.id, question.questtext, question.questdate, images, user.name AS user_name, email, module.name as module_name
                                            FROM question
                                            INNER JOIN user ON question.userid = user.id
                                            INNER JOIN module ON question.moduleid = module.id
                                            ORDER BY question.questdate DESC, question.id DESC');
        return $questions->fetchAll();
    }

    function getQuestion($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT question.*, user.name as username
                                FROM question
                                JOIN user ON question.userid = user.id
                                WHERE question.id = :id',
                                $parameters);
        return $query->fetch();
    }

    function insertQuestion($pdo, $questtext, $images, $userid, $moduleid) {
        $query = 'INSERT INTO question (questtext, questdate, images, userid, moduleid)
                  VALUES (:questtext, NOW(), :images, :userid, :moduleid)';
        $parameters = [':questtext' => $questtext, ':images' => $images, ':userid' => $userid, ':moduleid' => $moduleid];
        query($pdo, $query, $parameters);
    }

    function deleteQuestion($pdo, $id){
        $parameters = [':id' => $id];
        query($pdo, 'DELETE FROM question WHERE id = :id', $parameters);
    }

    function editQuestion($pdo, $questid, $questtext, $images, $moduleid){
        $query = 'UPDATE question 
                  SET questtext = :questtext,
                  images = :images,
                  moduleid = :moduleid
                  WHERE id = :id';
        $parameters = [':id' => $questid, ':questtext' => $questtext, ':images' => $images, ':moduleid' => $moduleid];
        query($pdo, $query, $parameters);
    }

    function totalQuestions($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM question');
        $row = $query->fetch();
        return $row[0];
    }

    // ------------------Admin Zone------------------
    // -----------Manage Questions-----------
    function getQuestionById($pdo, $id) {
        $sql = "SELECT q.*, u.name AS author_name, m.name AS module_name
                FROM question q
                JOIN user u ON q.userid = u.id
                JOIN module m ON q.moduleid = m.id
                WHERE q.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getAnswersByQuestionId($pdo, $questionId) {
        $sql = "SELECT * FROM answers WHERE question_id = :q_id ORDER BY created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':q_id' => $questionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -----------Manage Answers-----------
    function deleteAnswer($pdo, $id) {
        $sql = "DELETE FROM answers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }    

    // -----------Manage Users-----------
    function totalUsers($pdo) {
        $users = query($pdo, 'SELECT COUNT(*) FROM user');
        $row = $users->fetch();
        return $row[0];
    }

    function getAllUsers($pdo) {
        $sql = "SELECT u.id, u.name, u.email, u.created_at
                FROM user u
                JOIN userrole ur ON u.id = ur.userid
                WHERE ur.roleid = 2"; // Only users
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getUserById($pdo, $id) {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function deleteUser($pdo, $id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    function updateUser($pdo, $id, $name, $email) {
        $sql = "UPDATE user SET name = :name, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // -----------Manage Modules-----------
    function totalModules($pdo) {
        $modules = query($pdo, 'SELECT * FROM module');
        return $modules->fetchAll();
    }

    function getAllModules($pdo) {
        $sql = "SELECT m.*, COUNT(q.id) AS question_count
                FROM module m
                LEFT JOIN question q ON m.id = q.moduleid
                GROUP BY m.id
                ORDER BY question_count DESC, m.created_at DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    function getModuleById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM module WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function addModule($pdo, $name) {
        $stmt = $pdo->prepare("INSERT INTO module (name) VALUES (:name)");
        $stmt->execute([':name' => $name]);
    }

    function updateModule($pdo, $id, $name) {
        $stmt = $pdo->prepare("UPDATE module SET name = :name WHERE id = :id");
        $stmt->execute([':name' => $name, ':id' => $id]);
    }

    function deleteModule($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM module WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    // ------------------Admin Zone End------------------

    function tableExists($pdo, $tableName) {
        try {
            $result = $pdo->query("SHOW TABLES LIKE '$tableName'");
            return $result->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }


    // Searching & Pagination
    function searchQuestions($pdo, $keyword) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                WHERE q.questtext LIKE :kw
                ORDER BY q.questdate DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':kw' => '%' . $keyword . '%'
        ]);
        return $stmt->fetchAll();
    }

    function getAllQuestionsPaginated($pdo, $limit, $offset) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                ORDER BY q.questdate DESC, q.id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function countAllQuestions($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM question");
    return $stmt->fetchColumn();
    }

    function countSearchResults($pdo, $keyword) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM question WHERE questtext LIKE :kw");
        $stmt->execute([':kw' => '%' . $keyword . '%']);
        return $stmt->fetchColumn();
    }

    function searchQuestionsPaginated($pdo, $keyword, $limit, $offset) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                WHERE q.questtext LIKE :kw
                ORDER BY q.questdate DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':kw', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    