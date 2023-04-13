<?php


namespace Classes;

use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class Comment
{
    private User $user;
    private string $commentText;
    private DateTime $publicationDateTime;

    public function __construct(User $user, string $commentText)
    {
        $this->user=$user;
        $this->commentText=$this->checkCommentText($commentText);
        $this->publicationDateTime=new DateTime();        
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getCommentText()
    {
        return $this->commentText;
    }

    public function getPublicationDateTime()
    {
        return $this->publicationDateTime;
    }

    public function checkCommentText(string $commentText)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($commentText, [
            new NotBlank(),
        ]); 

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo "'$commentText' is invalid comment<br>"; 
                echo $violation->getMessage().'<br><br>';
                return -1;
            }
        }

        return $commentText;       
    }

    public function showInfo()
    {
        echo "<dl>" .
                "<h3>" . $this->user->getUsername() . "</h3><br>" .
                "<dd>" . $this->commentText . "</dd><br>" .
             "</dl>";
    }
}
