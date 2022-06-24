using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Linq;
using System.Threading.Tasks;

namespace MVC_School.Data
{
    public class DocentVakkenViewComponent : ViewComponent
    {
        private readonly SchoolDbContext _context;

        public DocentVakkenViewComponent(SchoolDbContext context)
        {
            _context = context;
        }

        public async Task<IViewComponentResult> InvokeAsync(int id)
        {
            var vakken = await _context.Vakken
                .Where(d => d.DocentId == id)
                .ToListAsync();
            return View(vakken);
        }
    }
}
