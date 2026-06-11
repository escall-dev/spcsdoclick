<?php
namespace App\Models;

class ReferenceRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllLDTypes()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ld_types ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllModalities()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM modalities ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllClassifications()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM classifications ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllTrainingCodes($category = 'activity_code')
    {
        $stmt = $this->pdo->prepare("SELECT * FROM training_codes WHERE category = ? ORDER BY code_name ASC");
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    public function addTrainingCode($code, $title, $desc, $category = 'activity_code')
    {
        $stmt = $this->pdo->prepare("INSERT INTO training_codes (code_name, title, description, category) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$code, $title, $desc, $category]);
    }

    public function updateTrainingCode($id, $code, $title, $desc)
    {
        $stmt = $this->pdo->prepare("UPDATE training_codes SET code_name = ?, title = ?, description = ? WHERE id = ?");
        return $stmt->execute([$code, $title, $desc, $id]);
    }

    public function deleteTrainingCode($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM training_codes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Classifications
    public function addClassification($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO classifications (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function updateClassification($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE classifications SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function deleteClassification($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM classifications WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Modalities
    public function addModality($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO modalities (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function updateModality($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE modalities SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function deleteModality($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM modalities WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // L&D Types
    public function addLDType($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO ld_types (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function updateLDType($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE ld_types SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function deleteLDType($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM ld_types WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Job Embedded Learning
    public function getAllJobEmbeddedLearnings()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM job_embedded_learning ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addJobEmbeddedLearning($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO job_embedded_learning (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function updateJobEmbeddedLearning($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE job_embedded_learning SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function deleteJobEmbeddedLearning($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM job_embedded_learning WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
