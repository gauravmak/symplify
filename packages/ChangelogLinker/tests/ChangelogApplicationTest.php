<?php declare(strict_types=1);

namespace Symplify\ChangelogLinker\Tests;

use PHPUnit\Framework\TestCase;
use Symplify\ChangelogLinker\ChangelogApplication;
use Symplify\ChangelogLinker\Worker\BracketsAroundReferencesWorker;
use Symplify\ChangelogLinker\Worker\DiffLinksToVersionsWorker;
use Symplify\ChangelogLinker\Worker\LinksToReferencesWorker;

final class ChangelogApplicationTest extends TestCase
{
    /**
     * @var ChangelogApplication
     */
    private $changelogApplication;

    protected function setUp(): void
    {
        $this->changelogApplication = new ChangelogApplication('https://github.com/Symplify/Symplify');
        $this->changelogApplication->addWorker(new BracketsAroundReferencesWorker());
        $this->changelogApplication->addWorker(new DiffLinksToVersionsWorker());
        $this->changelogApplication->addWorker(new LinksToReferencesWorker());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testProcess(string $originalFile, string $processedFile): void
    {
        $this->assertStringEqualsFile($processedFile, $this->changelogApplication->processFile($originalFile));
    }

    /**
     * @return mixed[][]
     */
    public function dataProvider(): array
    {
        return [
            [__DIR__ . '/ChangelogApplicationSource/before/01.md', __DIR__ . '/ChangelogApplicationSource/after/01.md'],
            [__DIR__ . '/ChangelogApplicationSource/before/02.md', __DIR__ . '/ChangelogApplicationSource/after/02.md'],
            [__DIR__ . '/ChangelogApplicationSource/before/03.md', __DIR__ . '/ChangelogApplicationSource/after/03.md'],
        ];
    }
}
