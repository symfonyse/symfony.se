<?php

namespace Symfonyse\EventBundle\ContentProvider;

use DMS\Bundle\MeetupApiBundle\Service\ClientFactory;
use DMS\Service\Meetup\AbstractMeetupClient;
use Symfonyse\EventBundle\Entity\Event;

class MeetupContentProvider implements EventContentProvider
{
    /**
     * @var AbstractMeetupClient
     */
    private $client;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->client = $clientFactory->getKeyAuthClient();
    }

    /**
     * Get the next event.
     *
     * @return Event|null
     */
    public function getNextEvent()
    {
        $upcoming = $this->getUpcomingEvents();

        if ($upcoming) {
            return $upcoming[0];
        }

        return null;
    }

    /**
     * Get an array with upcoming events
     *
     * @return Event[]
     */
    public function getUpcomingEvents()
    {
        return $this->client->getEvents(['status' => 'upcoming']);
    }

    /**
     * Get a event entry
     *
     * @param $permalink
     *
     * @return Event|null
     */
    public function getEntry($permalink)
    {
        // TODO: Implement getEntry() method.
    }

    /**
     * Get all event entries
     */
    public function getAllEntries()
    {
        // TODO: Implement getAllEntries() method.
    }
}