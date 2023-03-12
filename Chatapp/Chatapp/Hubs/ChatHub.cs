using Microsoft.AspNetCore.SignalR;

namespace Chatapp.Hubs
{
    public class ChatHub
    {
        public async Task SendMessage(MessageProcessingHandler message) =>
            await Clients.All.SendAsync("receiveMessage", message);
    }
}
