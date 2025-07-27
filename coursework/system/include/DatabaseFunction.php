<?php
    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function allQuestions($pdo) {
        $questions = query($pdo, 'SELECT question.id, questtext, questdate, images, user.name AS user_name, email, module.name as module_name
                                            FROM question
                                            INNER JOIN user ON question.userid = user.id
                                            INNER JOIN module ON question.moduleid = module.id
                                            ORDER BY question.questdate DESC');
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
                  VALUES (:questtext, CURDATE(), :images, :userid, :moduleid)';
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

    function totalUsers($pdo) {
        $users = query($pdo, 'SELECT * FROM user');
        return $users->fetchAll();
    }

    function totalModules($pdo) {
        $modules = query($pdo, 'SELECT * FROM module');
        return $modules->fetchAll();
    }

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