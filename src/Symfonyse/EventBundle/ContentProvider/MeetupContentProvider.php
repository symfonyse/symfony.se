<?php

namespace Symfonyse\EventBundle\ContentProvider;

use DMS\Bundle\MeetupApiBundle\Service\ClientFactory;
use DMS\Service\Meetup\AbstractMeetupClient;
use Symfonyse\EventBundle\Entity\Event;
use Symfonyse\EventBundle\Entity\MeetupEvent;

class MeetupContentProvider implements EventContentProvider
{
    /**
     * @var AbstractMeetupClient
     */
    private $client;

    /**
     * @var string
     */
    private $groupName;

    public function __construct(ClientFactory $clientFactory, $groupName)
    {
        $this->client    = $clientFactory->getKeyAuthClient();
        $this->groupName = $groupName;
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
        $response = $this->client->getEvents(['group_urlname' => $this->groupName, 'status' => 'upcoming']);

        return array_map(array($this, 'createEntity'), $response->getData());
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
        list($id, $title) = explode('/', $permalink);

        $response = $this->client->getEvent(['id' => $id]);

        return $this->createEntity($response->getData());
    }

    /**
     * Get all event entries
     */
    public function getAllEntries()
    {
        $response = $this->client->getEvents(['group_urlname' => $this->groupName]);

        return array_map(array($this, 'createEntity'), $response->getData());
    }

    /**
     * Create a MeetupEvent instance from the API response
     *
     * @param $input
     *
     * @return MeetupEvent
     */
    protected function createEntity(array $input)
    {
        $input['time'] /= 1000;

        return new MeetupEvent($input);
    }
}