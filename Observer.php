<?php

interface Observer {
    public function update(NewsPublisher $publisher): void;
}

class NewsPublisher {
    private array $observers = [];
    private string $latestNews = '';

    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify(): void {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function publishNews(string $news): void {
        $this->latestNews = $news;
        echo "Publisher: New news published: $news\n";
        $this->notify();
    }

    public function getLatestNews(): string {
        return $this->latestNews;
    }
}

class EmailSubscriber implements Observer {
    public function __construct(private string $email) {}

    public function update(NewsPublisher $publisher): void {
        echo "EmailSubscriber ({$this->email}): Received news - " . $publisher->getLatestNews() . "\n";
    }
}

class LogSubscriber implements Observer {
    public function update(NewsPublisher $publisher): void {
        echo "LogSubscriber: Logging news - " . $publisher->getLatestNews() . "\n";
    }
}

// Usage
$publisher = new NewsPublisher();

$emailSubscriber1 = new EmailSubscriber('john@example.com');
$emailSubscriber2 = new EmailSubscriber('jane@example.com');
$logSubscriber = new LogSubscriber();

$publisher->attach($emailSubscriber1);
$publisher->attach($emailSubscriber2);
$publisher->attach($logSubscriber);

$publisher->publishNews('Design Patterns are awesome!');

$publisher->detach($emailSubscriber2);

echo "\nAfter detaching Jane:\n";
$publisher->publishNews('Observer Pattern implemented successfully.');
