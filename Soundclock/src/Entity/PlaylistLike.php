<?php

namespace App\Entity;

use App\Repository\PlaylistLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaylistLikeRepository::class)
 */
class PlaylistLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_playlist_like"})
     * @Groups({"show_playlist_like"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Playlist::class, inversedBy="playlistLikes")
     * @Groups({"list_playlist_like"})
     * @Groups({"show_playlist_like"})
     */
    private $playlistLiked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="playlistLikebyUser")
     * @Groups({"list_playlist_like"})
     * @Groups({"show_playlist_like"})
     */
    private $userWhoLikePlaylist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistLiked(): ?Playlist
    {
        return $this->playlistLiked;
    }

    public function setPlaylistLiked(?Playlist $playlistLiked): self
    {
        $this->playlistLiked = $playlistLiked;

        return $this;
    }

    public function getUserWhoLikePlaylist(): ?User
    {
        return $this->userWhoLikePlaylist;
    }

    public function setUserWhoLikePlaylist(?User $userWhoLikePlaylist): self
    {
        $this->userWhoLikePlaylist = $userWhoLikePlaylist;

        return $this;
    }
}
