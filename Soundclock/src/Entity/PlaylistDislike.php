<?php

namespace App\Entity;

use App\Repository\PlaylistDislikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaylistDislikeRepository::class)
 */
class PlaylistDislike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_playlist_dislike"})
     * @Groups({"show_playlist_dislike"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Playlist::class, inversedBy="playlistDislikes")
     * @Groups({"list_playlist_dislike"})
     * @Groups({"show_playlist_dislike"})
     */
    private $playlistDisliked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="playlistDislikeByUser")
     * @Groups({"list_playlist_dislike"})
     * @Groups({"show_playlist_dislike"})
     */
    private $userWhoDislikePlaylist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistDisliked(): ?Playlist
    {
        return $this->playlistDisliked;
    }

    public function setPlaylistDisliked(?Playlist $playlistDisliked): self
    {
        $this->playlistDisliked = $playlistDisliked;

        return $this;
    }

    public function getUserWhoDislikePlaylist(): ?User
    {
        return $this->userWhoDislikePlaylist;
    }

    public function setUserWhoDislikePlaylist(?User $userWhoDislikePlaylist): self
    {
        $this->userWhoDislikePlaylist = $userWhoDislikePlaylist;

        return $this;
    }
}
