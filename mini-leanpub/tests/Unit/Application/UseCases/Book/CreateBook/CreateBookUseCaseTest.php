<?php

namespace Tests\MiniLeanpub\Unit\Application\UseCases\Book\CreateBook;

use PHPUnit\Framework\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    public function testShouldCreateANewBookViaUseCase()
    {
        $useCase = new CreateBookUseCase($input, $repository);
        $result = $useCase->handle();

        $this->assertInstanceOf(BookCreateOutputDTO::class, $result);

        $data = $result->getData();

        $this->assertEquals('', $data['id']);
        $this->assertEquals('', $data['title']);
    }
}
