<?php

namespace Tests\MiniLeanpub\Unit\Application\UseCases\Book\CreateBook;

use MiniLeanpub\Domain\Book\Entity\Book;
use PHPUnit\Framework\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    public function testShouldCreateANewBookViaUseCase()
    {
        $repository = $this->getRepositoryMock();

        $input = new BookCreateInputDTO('4f93cb20-2da7-4b33-ab07-81b7c6d58160',
            'My Awesome Book', 'My Awesome Book Desc', 25.9, 'book_path', 'text/markdown');

        $useCase = new CreateBookUseCase($input, $repository);
        $result = $useCase->handle();

        $this->assertInstanceOf(BookCreateOutputDTO::class, $result);

        $data = $result->getData();

        $this->assertEquals('4f93cb20-2da7-4b33-ab07-81b7c6d58160', $data['id']);
        $this->assertEquals('My Awesome Book', $data['title']);
    }

    private function getRepositoryMock()
    {
        $return = new \stdClass();
        $return->id = '4f93cb20-2da7-4b33-ab07-81b7c6d58160';
        $return->title = 'My Awesome Book';
        $return->description = 'My Awesome Book Desc';
        $return->price = 25.9;
        $return->book_path = 'book_path';

        $model = $this->createMock(Book::class);

        $mock = $this->getMockBuilder(BookEloquentRepository::class)
            ->onlyMethods(['create'])
            ->setConstructorArgs([$model])
            ->getMock();

        $mock->expects($this->once())
            ->method('create')
            ->willReturn($return);

        return $mock;
    }
}
