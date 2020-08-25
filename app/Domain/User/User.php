<?php
declare(strict_types=1);
namespace App\Domain\User;


class User
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private \DateTime $deletedAt;

    /**
     * User constructor.
     * @param string $id
     * @param string $firstName
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     * @param string $lastName OPTIONAL
     * @param \DateTime|null $deletedAt OPTIONAL
     */
    public function __construct(
        string $id,
        string $firstName,
        \DateTime $createdAt,
        \DateTime $updatedAt,
        string $lastName = "",
        \DateTime $deletedAt = null
    )
    {
        $this->setId($id);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setCreatedAt($createdAt);
        $this->setUpdatedAt($updatedAt);
        $this->setDeletedAt($deletedAt);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName = ""): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt = null): void
    {
        if ($deletedAt)
            $this->deletedAt = $deletedAt;
    }

    public function toArray(): array
    {
        $arrayResult = [];
        foreach ($this as $key => $name) {
            if ($name instanceof \DateTime)
                $name = $name->format('Y-m-d H:i:s');

            $arrayResult[$key] = $name;
        }

        return $arrayResult;
    }
}
