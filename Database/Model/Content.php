<?php

class Content
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Create new content
    public function createContent($title, $description, $image, $userId)
    {
        $sql = "INSERT INTO content (title, description, image, user_id)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$title, $description, $image, $userId]);

        return 'Content created successfully';
    }

    // Get all content
    public function getAllContent()
    {
        $sql = "SELECT * FROM content";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get content by ID
    public function getContentById($contentId)
    {
        $sql = "SELECT * FROM content WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$contentId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update content
    public function updateContent($contentId, $title, $description, $image)
    {
        $sql = "UPDATE content SET title = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$title, $description, $image, $contentId]);

        return 'Content updated successfully';
    }

    // Delete content
    public function deleteContent($contentId)
    {
        $sql = "DELETE FROM content WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$contentId]);

        return 'Content deleted successfully';
    }
}

?>
