<?php

namespace Simformsolutions\PasswordStrengthBundle\tests\Validator\Constraints;

use PHPUnit\Framework\TestCase;
use Simformsolutions\PasswordStrengthBundle\Validator\Constraints as SPVC;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class PasswordStrengthValidatorTest extends TestCase
{
    public function testTooShort()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;

        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->tooShortMessage), $this->equalTo(array('{{length}}' => $constraint->minLength)));

        $validator->validate('test', $constraint);
    }

    public static function providerTooShortMultiBytes(): array
    {
        return array(
            array('１２３４'),
            array('ééé'),
            array('こんに'),
            array('東京'),
        );
    }

    /**
     * @dataProvider providerTooShortMultiBytes
     */
    public function testTooShortMultiBytes($value)
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->tooShortMessage), $this->equalTo(array('{{length}}' => $constraint->minLength)));

        $constraint->minLength = 5;
        $constraint->requireLetters = false;
        $validator->validate($value, $constraint);
    }

    public function testNoLengthRestriction()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->minLength = 0;
        $validator->validate('test', $constraint);
    }

    public function testRequireLettersOffPass()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->requireLetters = false;
        $validator->validate('12345', $constraint);
    }

    public function testRequireLettersOnFail()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->missingLettersMessage));

        $constraint->requireLetters = true;
        $validator->validate('12345', $constraint);
    }

    public function testRequireCaseDiffOnFail()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->requireCaseDiffMessage));

        $constraint->requireCaseDiff = true;
        $validator->validate('abcde', $constraint);
    }

    public function testRequireCaseDiffOnPass()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->requireCaseDiff = true;
        $validator->validate('aBcDe', $constraint);
    }

    public function testRequireNumbersOffPass()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->requireNumbers = false;
        $validator->validate('abcdef', $constraint);
    }

    public function testRequireNumbersOnFail()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->missingNumbersMessage));

        $constraint->requireNumbers = true;
        $validator->validate('abcdef', $constraint);
    }

    public function testRequireNumbersOnPass()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->requireLetters = false;
        $constraint->requireNumbers = true;
        $validator->validate('12345', $constraint);
        $validator->validate('１２３４５６７８９', $constraint);
    }

    public function testRequireLettersNumbersPass()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->requireLetters = true;
        $constraint->requireNumbers = true;
        $validator->validate('abcd12345', $constraint);
        $validator->validate('１２３４abc５６７８９', $constraint);
    }

    public static function providerRequireSpecialsPass(): array
    {
        $testChars = "!@#$%^&*()_-+[]{}\|;:'\",./<>?`~¡™£¢∞§¶•–—=±⁄€‹›ﬁﬂ‡°";

        $arr = array();
        foreach (preg_split('/(?<!^)(?!$)/u', $testChars) as $ch) {
            $arr[] = array($ch);
        }

        return $arr;
    }

    /**
     * @dataProvider providerRequireSpecialsPass
     */
    public function testRequireSpecialsPass($value)
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->never())
            ->method('addViolation');

        $constraint->minLength = 1;
        $constraint->requireLetters = false;
        $constraint->requireNumbers = false;
        $constraint->requireSpecials = true;
        $validator->validate($value, $constraint);
    }

    public function testRequireSpecialsFail()
    {
        $constraint = new SPVC\PasswordStrength;
        $validator = new SPVC\PasswordStrengthValidator;
        $mockContext = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();
        $validator->initialize($mockContext);

        $mockContext->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($constraint->missingSpecialsMessage));

        $constraint->minLength = 1;
        $constraint->requireLetters = false;
        $constraint->requireNumbers = false;
        $constraint->requireSpecials = true;
        $validator->validate('1234abcd', $constraint);
    }
}
